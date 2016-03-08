<?php namespace Bestboysmedialab\LanguageList;

/*
 * This file is part of Bestboysmedialab-LanguageList
 * Reference : Monarobase-CountryList by Monarobase <jonathan@monarobase.net>
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


/**
 * LanguageList
 *
 * @author Volker Ansmann <volker.ansmann@bestboys-medialab.com>
 */
class LanguageList {

	/**
	 * @var string
	 * Path to the directory containing language data.
	 */
	protected $dataDir;

	/**
	 * @var array
	 * Cached data.
	 */
	protected $dataCache = array();

	/**
	 * Constructor.
	 *
	 * @param string|null $dataDir  Path to the directory containing languages data
	 */
	public function __construct($dataDir = null)
	{
		if (!isset($dataDir))
		{
			$r = new \ReflectionClass('Umpirsky\Language\Builder\Builder');
			$dataDir = sprintf('%s/../../../../language', dirname($r->getFileName()));
		}

		if (!is_dir($dataDir))
		{
			throw new \RuntimeException(sprintf('Unable to locate the Language data directory at "%s"', $dataDir));
		}

		$this->dataDir = realpath($dataDir);
	}

	/**
	 * @return string  The language data directory.
	 */
	public function getDataDir()
	{
		return $this->dataDir;
	}

	/**
	 * Returns one language.
	 *
	 * @param string $languageCode  The Language
	 * @param string $locale       The locale (default: en)
	 * @return string
	 * @throws LanguageNotFoundException  If the language code doesn't match any language.
	 */
	public function getOne($languageCode, $locale = 'en')
	{
		$languageCode = mb_strtoupper($languageCode);
		$locales = $this->loadData($locale, 'php');

		if (!$this->has($languageCode, $locale))
		{
			throw new LanguageNotFoundException($languageCode);
		}

		return $locales[mb_strtoupper($languageCode)];
	}

	/**
	 * Returns a list of languages.
	 *
	 * @param string $locale  The locale (default: en)
	 * @param string $format  The format (default: php)
	 * @return array
	 */
	public function getList($locale = 'en', $format = 'php')
	{
		return $this->loadData($locale, $format);
	}

	/**
	 * @param string $locale  The locale
	 * @param array $data     An array (list) with language data
	 * @return LanguageList    The instance of LanguageList to enable fluent interface
	 */
	public function setList($locale, array $data)
	{
		$this->dataCache[$locale] = $data;

		return $this;
	}

	/**
	 * A lazy-loader that loads data from a PHP file if it is not stored in memory yet.
	 *
	 * @param string $locale  The locale
	 * @param string $format  The format (default: php)
	 * @return array          An array (list) with language
	 */
	protected function loadData($locale, $format)
	{
		if (!isset($this->dataCache[$locale][$format]))
		{
			
			$file = sprintf('%s/%s/country.'.$format, $this->dataDir, $locale);

			if (!is_file($file))
			{
				throw new \RuntimeException(sprintf('Unable to load the language data file "%s"', $file));
			}

			$this->dataCache[$locale][$format] = ($format == 'php') ? require $file : file_get_contents($file);
		}

		return $this->sortData($locale, $this->dataCache[$locale][$format]);
	}

	/**
	 * Sorts the data array for a given locale, using the locale translations.
	 * It is UTF-8 aware if the Collator class is available (requires the intl
	 * extension).
	 *
	 * @param string $locale  The locale whose collation rules should be used.
	 * @param array  $data    Array of strings to sort.
	 * @return array          The $data array, sorted.
	 */
	protected function sortData($locale, $data)
	{
		if (is_array($data))
		{
			if (class_exists('Collator'))
			{
				$collator = new \Collator($locale);
				$collator->asort($data);
			}
			else
			{
				asort($data);
			}
		}

		return $data;
	}

	/**
	 * Indicates whether or not a given $languageCode matches a country.
	 * 
	 * @param string $languageCode  A 2-letter country code
	 * @param string $locale       The locale (default: en)
	 * @return bool                <code>true</code> if a match was found, <code>false</code> otherwise
	 */
	public function has($languageCode, $locale = 'en')
	{
		$locales = $this->loadData($locale, 'php');

		return isset($locales[mb_strtoupper($languageCode)]);
	}
}

