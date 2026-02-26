<?php
if (!defined('init_config'))
{
	header('HTTP/1.0 404 not found');
	exit;
}

//Default PDO Error handler
$PDO_config['errorHandler'] = PDO::ERRMODE_WARNING;
//Default PDO Fetch Mode
$PDO_config['fetch'] = PDO::FETCH_ASSOC;

//Website Database Connection Info
$config['DatabaseHost']     = getenv('DB_HOST')     ?: 'localhost';
$config['DatabaseUser']     = getenv('DB_USER')     ?: 'root';
$config['DatabasePass']     = getenv('DB_PASS')     ?: '';
$config['DatabaseName']     = getenv('DB_NAME')     ?: 'warcry';
$config['DatabaseEncoding'] = getenv('DB_ENCODING') ?: 'utf8';
