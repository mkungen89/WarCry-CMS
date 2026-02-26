<?php
if (!defined('init_config'))
{
	header('HTTP/1.0 404 not found');
	exit;
}

$auth_config['DatabaseHost']     = getenv('AUTH_DB_HOST')     ?: 'localhost';
$auth_config['DatabaseUser']     = getenv('AUTH_DB_USER')     ?: 'root';
$auth_config['DatabasePass']     = getenv('AUTH_DB_PASS')     ?: '';
$auth_config['DatabaseName']     = getenv('AUTH_DB_NAME')     ?: 'auth';
$auth_config['DatabaseEncoding'] = getenv('AUTH_DB_ENCODING') ?: 'utf8';
