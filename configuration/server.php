<?php
if (!defined('init_config'))
{	
	header('HTTP/1.0 404 not found');
	exit;
}

//Website Database Connection Info
$server_config['CORE'] = 'trinity';

//Realms configuration
$realms_config[1] = array(
	'name' 			=> getenv('REALM1_NAME')         ?: 'Realm 1',
	'descr' 		=> getenv('REALM1_DESCR')        ?: 'Blizzlike',
	'Database' 		=> array(
		'host' 		=> getenv('REALM1_DB_HOST')      ?: 'localhost',
		'name' 		=> getenv('REALM1_DB_NAME')      ?: 'characters',
		'user' 		=> getenv('REALM1_DB_USER')      ?: 'root',
		'pass' 		=> getenv('REALM1_DB_PASS')      ?: '',
		'encoding' 	=> 'utf8'
	),
	'address' 		=> getenv('REALM1_ADDRESS')      ?: '127.0.0.1',
	'port' 			=> getenv('REALM1_PORT')         ?: '8085',
	'soap_protocol' => getenv('REALM1_SOAP_PROTOCOL') ?: 'http',
	'soap_address'  => getenv('REALM1_SOAP_ADDRESS')  ?: '127.0.0.1',
	'soap_port'     => getenv('REALM1_SOAP_PORT')     ?: '7878',
	'soap_user'     => getenv('REALM1_SOAP_USER')     ?: '',
	'soap_pass'     => getenv('REALM1_SOAP_PASS')     ?: '',
	'UPDATE_TIME' 	=> '10 minutes',
);