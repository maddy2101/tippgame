<?php
namespace ABS\Tippgame\Tests\Unit;

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
use Prophecy\Argument;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class TournamentTest extends UnitTestCase
{

    /**
     * @test
     */
    public function getSortedRoundsSortsRoundsByStartDateAscending()
    {
        /** @var Tournament $subject */
        $subject = GeneralUtility::makeInstance(Tournament::class);
        $rounds = new ObjectStorage();
        /** @var Round $round_1 */
        $round_1 = GeneralUtility::makeInstance(Round::class);
        $round_1->setStart(date_create_from_format('d.m.Y', '1.1.2000'));
        $rounds->attach($round_1);

        /** @var Round $round_2 */
        $round_2 = GeneralUtility::makeInstance(Round::class);
        $round_2->setStart(date_create_from_format('d.m.Y', '2.2.2000'));
        $rounds->attach($round_2);

        /** @var Round $round_3 */
        $round_3 = GeneralUtility::makeInstance(Round::class);
        $round_3->setStart(date_create_from_format('d.m.Y', '9.9.1999'));
        $rounds->attach($round_3);

        $subject->setRounds($rounds);
        $this->assertEquals(2, $subject->getSortedRounds()->getPosition($round_1));
        $this->assertEquals(3, $subject->getSortedRounds()->getPosition($round_2));
        $this->assertEquals(1, $subject->getSortedRounds()->getPosition($round_3));
    }

    /**
     * @test
     */
    public function getSortedRoundsIgnoresRoundsWithoutStart()
    {
        /** @var Tournament $subject */
        $subject = GeneralUtility::makeInstance(Tournament::class);
        $rounds = new ObjectStorage();
        /** @var Round $round_1 */
        $round_1 = GeneralUtility::makeInstance(Round::class);
        $rounds->attach($round_1);

        $subject->setRounds($rounds);
        $this->assertEquals(new ObjectStorage(), $subject->getSortedRounds());
    }

}
