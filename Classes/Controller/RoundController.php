<?php
namespace ABS\Tippgame\Controller;

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
use ABS\Tippgame\Domain\Model\Round;
use ABS\Tippgame\Domain\Model\Tournament;
use ABS\Tippgame\Domain\Repository\TournamentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;

/**
 * Round Controller
 */
class RoundController extends ActionController
{

    /**
     * @var TournamentRepository
     */
    protected $tournamentRepository;

    /**
     *
     */
    public function initializeAction()
    {
        if (isset($this->arguments['round'])) {
            $this->arguments['round']
                ->getPropertyMappingConfiguration()
                ->forProperty('start')
                ->setTypeConverterOption(
                    DateTimeConverter::class,
                    DateTimeConverter::CONFIGURATION_DATE_FORMAT,
                    'd.m.Y'
                );
            $this->arguments['round']
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
     * @param TournamentRepository $tournamentRepository
     */
    public function injectTournamentRepository(TournamentRepository $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    /**
     * @param Tournament|null $tournament
     */
    public function newAction(Tournament $tournament = null)
    {
        $this->view->assign('tournament', $tournament);
    }

    /**
     * @param Round $round
     */
    public function createAction(Round $round)
    {
        $tournament = $round->getTournament();
        $tournament->getRounds()->attach($round);
        $this->tournamentRepository->update($tournament);
        $this->addFlashMessage('Tournament successful created', 'Success');
        $this->redirect('show', 'Tournament', null, ['tournament' => $tournament]);
    }

}
