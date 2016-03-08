# Language List

Language List is a package for Laravel 5 which lists all langauges with names and ISO 3166-1 codes in all languages and data formats.


## Installation

Add `bestboysmedialab/language-list` to `composer.json`.

    "bestboysmedialab/language-list": "1.1.1"
    
Run `composer update` to pull down the latest version of Country List.

Now open up `app/config/app.php` and add the service provider to your `providers` array.

    'providers' => array(
        'Bestboysmedialab\LanguageList\LanguageListServiceProvider',
    )

Now add the alias.

    'aliases' => array(
        'Languages' => 'Bestboysmedialab\LanguageList\LanguageListFacade',
    )


## Usage

- Locale (en, en_US, fr, fr_CA...)
- Format (csv, html, json, mysql.sql, php, postgresql.sql, sqlite.sql, txt, xml, yaml)


Get all languages

	Route::get('/', function()
	{
		return Languages::getList('en', 'json');
	});


Get one Language

	Route::get('/', function()
	{
		return Languages::getOne('RU', 'en');
	});