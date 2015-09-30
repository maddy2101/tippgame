<?php
namespace ABS\Tippgame\Domain\Model;

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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Round Model
 */
class Round extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var \DateTime
     */
    protected $start;

    /**
     * @var \DateTime
     */
    protected $stop;

    /**
     * @var \ABS\Tippgame\Domain\Model\Tournament
     */
    protected $tournament = null;

    /**
     * get the Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * sets the Title
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * get the Start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * sets the Start
     *
     * @param \DateTime $start
     *
     * @return void
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * get the Stop
     *
     * @return \DateTime
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * sets the Stop
     *
     * @param \DateTime $stop
     *
     * @return void
     */
    public function setStop($stop)
    {
        $this->stop = $stop;
    }

    /**
     * get the Tournament
     *
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * sets the Tournament
     *
     * @param Tournament $tournament
     *
     * @return void
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    }
}
