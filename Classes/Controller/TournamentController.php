<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
namespace ABS\Tippgame\Controller;

use ABS\Tippgame\Domain\Model\Team;
use ABS\Tippgame\Domain\Model\Tournament;
use ABS\Tippgame\Domain\Repository\TeamRepository;
use ABS\Tippgame\Domain\Repository\TournamentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;

/**
 * Tournament Controller
 */
class TournamentController extends ActionController
{

    /**
     * @var TournamentRepository
     */
    protected $tournamentRepository;

    /**
     * @var TeamRepository
     */
    protected $teamRepository;

    /**
     * @var PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @param TournamentRepository $tournamentRepository
     */
    public function injectTournamentRepository(TournamentRepository $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function injectTeamRepository(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param PersistenceManager $persistenceManager
     */
    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    public function initializeAction()
    {
        if (isset($this->arguments['tournament'])) {
            $this->arguments['tournament']
                ->getPropertyMappingConfiguration()
                ->forProperty('start')
                ->setTypeConverterOption(
                    DateTimeConverter::class,
                    DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    'd.m.Y'
                );
            $this->arguments['tournament']
                ->getPropertyMappingConfiguration()
                ->forProperty('stop')
                ->setTypeConverterOption(
                    DateTimeConverter::class,
                    DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    'd.m.Y'
                );
        }
    }

    /**
     * render current tournament
     */
    public function currentAction(Tournament $tournament = null)
    {
        $tournaments = $this->tournamentRepository->findAllCurrentAndFuture();
        if ($tournament !== null) {
            $this->view->assign('openTournament', $tournament);
        }
        $this->view->assign('tournaments', $tournaments);
    }

    /**
     *
     */
    public function newAction()
    {
        // do nothing, the framework is working here.
    }

    /**
     * @param Tournament $tournament
     * @ignorevalidation $tournament
     */
    public function editAction(Tournament $tournament)
    {
        $teams = $this->teamRepository->findAll();
        $this->view->assign('teams', $teams);
        $this->tournamentRepository->add($tournament);
        $this->persistenceManager->persistAll();
        $tournament = $this->tournamentRepository->findOneByTitle($tournament->getTitle());
        $this->view->assign('tournament', $tournament);
    }

    /**
     * @param Tournament $tournament
     *
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function updateAction(Tournament $tournament)
    {
        $teams = new ObjectStorage();
        $existingTeams = $this->request->getArgument('teams');
        if (count($existingTeams) > 0) {
            foreach ($existingTeams as $teamUid) {
                $team = $this->teamRepository->findByUid((int)$teamUid);
                if ($team instanceof Team) {
                    $teams->attach($team);
                }
            }
        }
        $toCreate = $this->request->getArgument('create');
        $teamsToCreate = $toCreate['teams'];
        if (count($teamsToCreate) > 0) {
            foreach ($teamsToCreate as $teamName) {
                if (strlen($teamName)) {
                    $team = $this->objectManager->get(Team::class);
                    $team->setName($teamName);
                    $teams->attach($team);
                }
            }
        }
        $tournament->setTeams($teams);

        $this->tournamentRepository->update($tournament);
        $this->forward('current', null, null, ['tournament' => $tournament]);
    }
}
