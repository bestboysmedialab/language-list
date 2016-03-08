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

class LanguageNotFoundException extends \Exception{

	/**
	 * Constructor.
	 * 
	 * @param string $languageCode  A 2-letter country code
	 */
	public function __construct($languageCode)
	{
		parent::__construct('Language "'.$languageCode.'" not found.');
	}

}