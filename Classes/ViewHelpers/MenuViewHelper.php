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
 * Creates a plugin specific menu
 */
class MenuViewHelper extends AbstractViewHelper
{

    /**
     * @param string $controller active controller
     * @param string $action active action
     *
     * @return array
     */
    public function render($controller, $action)
    {
        $menu = [
            'Tournament' => [
                'current' => 0,
                'old' => 0,
                'new' => 0
            ]
        ];
        $menu[$controller][$action] = 1;
        return $menu;
    }


}
