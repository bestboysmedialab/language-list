<?php
/*
 * This file is part of Bestboysmedialab-LanguageList
 *
 * (c) 2016 best boys media lab GmbH & Co. KG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 *
 * @category    Bestboysmedialab
 * @package     LanguageList
 * @copyright   (c) 2016 best boys media lab GmbH & Co. KG <volker.ansmann@bestboys-medialab.com>
 * @link        http://www.bestboys-medialab.com
 */

namespace Bestboysmedialab\LanguageList;

use Illuminate\Support\Facades\Facade;

/**
 * LanguageListFacade
 *
 * @author Volker Ansmann <volker.ansmann@bestboys-medialab.com>
 */ 
class LanguageListFacade extends Facade {
 
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LanguageList::class; }
 
}