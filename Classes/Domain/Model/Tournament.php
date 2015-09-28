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
     * @var ObjectStorage<\ABS\Tippgame\Domain\Model\Player>
     */
    protected $players = null;

    /**
     * @var ObjectStorage<\ABS\Tippgame\Domain\Model\Round>
     */
    protected $rounds = null;
}
