<?php
if (!defined('init_config'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

$config['SiteName'] = getenv('APP_NAME') ?: 'warcry';

$config['RootPath'] = dirname(__DIR__);              //(No slash at the end)
$config['BaseURL']  = rtrim(getenv('APP_URL') ?: 'http://localhost', '/'); //(No slash at the end)

//Must be unique for each website
$config['AuthCookieName'] = getenv('APP_COOKIE_NAME') ?: 'Project-Reborn';

//Minifier Settings
//StyleFolderURL rewrites the URLs for the image in the CSS files
$config['StyleFolderURL'] = '/template/style/'; //(With slash at the end)

//E-mail Address
$config['Email'] = getenv('APP_EMAIL') ?: 'info@localhost';

//Time settings
$config['TimeZone']       = getenv('APP_TIMEZONE') ?: 'Europe/Berlin';
$config['TimeZoneOffset'] = getenv('APP_TIMEZONE_OFFSET') ?: '+1';

//WoW Database URL (leave empty if not using a game database)
$config['WoWDB_URL'] = getenv('WOWDB_URL') ?: '';  //(No slash at the end)
//Complete URL to the power.js
$config['WoWDB_JS']  = getenv('WOWDB_JS') ?: '';