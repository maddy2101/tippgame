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

use ABS\Tippgame\Domain\Model\Tournament;
use ABS\Tippgame\Domain\Repository\TournamentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
    public function currentAction()
    {
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
        $this->tournamentRepository->update($tournament);
    }
}
