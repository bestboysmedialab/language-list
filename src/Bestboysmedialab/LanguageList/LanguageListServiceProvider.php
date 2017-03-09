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

use Illuminate\Support\ServiceProvider;

/**
 * LanguageListServiceProvider
 *
 * @author Volker Ansmann <volker.ansmann@bestboys-medialab.com>
 */ 
class LanguageListServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('LanguageList', function ($app) {
			return new LanguageList;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('languagelist');
	}

}
