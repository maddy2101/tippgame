<?php
namespace ABS\Tippgame\Domain\Repository;

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
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Tournament Repository
 */
class TournamentRepository extends Repository
{

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllOrderedByStart()
    {
        $query = $this->createQuery();
        $query->setOrderings(['start' => QueryInterface::ORDER_DESCENDING]);

        return $query->execute();
    }

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAllCurrentAndFuture()
    {
        $today = new \DateTime('midnight');
        $query = $this->createQuery();
        $query->matching(
            $query->greaterThanOrEqual('stop', $today->getTimestamp())
        );
        $query->setOrderings(['start' => QueryInterface::ORDER_DESCENDING]);
        return $query->execute();
    }
}
