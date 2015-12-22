<?php
namespace ABS\Tippgame\Domain\Model;

/*
 * This file is part of the TYPO3 extension tippgame
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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Tournament Model
 */
class Tournament extends AbstractEntity
{

    /**
     * @var string
     * @validate NotEmpty
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
     * @var int
     */
    protected $amountTeams = 0;

    /**
     * @var int
     */
    protected $amountRounds = 0;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     */
    protected $players = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ABS\Tippgame\Domain\Model\Round>
     */
    protected $rounds = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ABS\Tippgame\Domain\Model\Team>
     */
    protected $teams = null;

    /**
     * @var \ABS\Tippgame\Domain\Model\Team
     */
    protected $winner = null;

    /**
     * Tournament constructor.
     */
    public function __construct() {
        $this->players = new ObjectStorage();
        $this->rounds = new ObjectStorage();
        $this->teams = new ObjectStorage();
    }

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
     * get the Players
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * sets the Players
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $players
     *
     * @return void
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * get the Rounds
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * sets the Rounds
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $rounds
     *
     * @return void
     */
    public function setRounds($rounds)
    {
        $this->rounds = $rounds;
    }

    /**
     * @return ObjectStorage
     */
    public function getSortedRounds()
    {
        $rounds = $this->getRounds();
        $sortedRounds = new ObjectStorage();
        $sortingRounds = [];
        /** @var Round $round */
        foreach ($rounds as $round) {
            if ($round->getStart() instanceof \DateTime && $round->getStart()->getTimestamp() > 0) {
                $sortingRounds[$round->getStart()->getTimestamp()] = $round;
            }
        }
        ksort($sortingRounds);
        foreach ($sortingRounds as $round) {
            $sortedRounds->attach($round);
        }
        return $sortedRounds;

    }

    /**
     * get the AmountTeams
     *
     * @return int
     */
    public function getAmountTeams()
    {
        return $this->amountTeams;
    }

    /**
     * sets the AmountTeams
     *
     * @param int $amountTeams
     *
     * @return void
     */
    public function setAmountTeams($amountTeams)
    {
        $this->amountTeams = $amountTeams;
    }

    /**
     * get the AmountRounds
     *
     * @return int
     */
    public function getAmountRounds()
    {
        return $this->amountRounds;
    }

    /**
     * sets the AmountRounds
     *
     * @param int $amountRounds
     *
     * @return void
     */
    public function setAmountRounds($amountRounds)
    {
        $this->amountRounds = $amountRounds;
    }

    /**
     * get the Winner
     *
     * @return Team
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * sets the Winner
     *
     * @param Team $winner
     *
     * @return void
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }

    /**
     * get the Teams
     *
     * @return ObjectStorage
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * sets the Teams
     *
     * @param ObjectStorage $teams
     *
     * @return void
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
    }



}
