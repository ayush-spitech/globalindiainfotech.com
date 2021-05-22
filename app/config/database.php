<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*------server
'username' => 'bcrevents_db',
	'password' => 'KaMFZLVMNiZ}',
	'database' => 'bcrevents_event_manager',
	*/

	$active_group = 'default';
	$query_builder = TRUE;
	$db['default'] = array(
		'dsn'	=> '',	
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
		);

	if (is_localhost()) {
		$db['default']['hostname'] = 'localhost';
		$db['default']['username'] = 'root';
		$db['default']['password'] = '';
		$db['default']['database'] = 'globalindiainfotech';
	}else{
        $db['default']['hostname'] = 'localhost';
        $db['default']['username'] = 'swsplnet_globali';
        $db['default']['password'] = 'pv,1E6ngM5~[';
        $db['default']['database'] = 'swsplnet_globalindiainfotech';
	}
	//print_r($db);