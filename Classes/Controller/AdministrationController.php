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
use ABS\Tippgame\Domain\Repository\TournamentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * the central place for administration
 */
class AdministrationController extends ActionController
{

    /**
     * @var \ABS\Tippgame\Domain\Repository\TournamentRepository
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
     * list action
     */
    public function listAction()
    {
        $tournaments = $this->tournamentRepository->findAllOrderedByStart();
        $this->view->assign('tournaments', $tournaments);
        $this->view->assign('today', new \DateTime('now'));
    }
}
