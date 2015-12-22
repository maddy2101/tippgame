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
namespace ABS\Tippgame\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * create partials based on counting variable (is in fact PHP for() )
 */
class LoopViewHelper extends AbstractViewHelper
{

    /**
     * @param int $start
     * @param int $end
     *
     * @return string
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
     */
    public function render($start = 0, $end = PHP_INT_MAX)
    {
        $content = '';
        for ($i = (int)$start; $i < (int)$end; $i++) {
            $this->templateVariableContainer->add('i', $i);
            $this->templateVariableContainer->add('iCycle', $i + 1);
            $content .= $this->renderChildren();
            $this->templateVariableContainer->remove('i');
            $this->templateVariableContainer->remove('iCycle');
        }
        return $content;
    }

}
