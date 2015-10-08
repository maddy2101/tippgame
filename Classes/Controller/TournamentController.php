<?php
namespace ABS\Tippgame\Controller;

/*
 * This file is part of the TYPO3 extension tippgame.
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

use ABS\Tippgame\Domain\Model\Tournament;
use ABS\Tippgame\Domain\Repository\TournamentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter;

class TournamentController extends ActionController
{

    /**
     * @var TournamentRepository
     */
    protected $tournamentRepository;

    /**
     * @param TournamentRepository $tournamentRepository
     */
    public function injectTournamentRepository(TournamentRepository $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    /**
     * list action for logged in user
     */
    public function listAction()
    {
    }

    /**
     *
     */
    public function newAction()
    {
        // do nothing, only show the template
    }

    /**
     *
     */
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
     * @param Tournament $tournament
     *
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function createAction(Tournament $tournament)
    {
        $this->addFlashMessage('Tournament successful created', 'Success');
        $this->tournamentRepository->add($tournament);
        $this->redirect('list', 'Administration');
    }

    /**
     * @param Tournament $tournament
     * @ignorevalidation $tournament
     */
    public function showAction(Tournament $tournament)
    {
        $this->view->assign('tournament', $tournament);
    }
}
