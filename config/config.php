<?php

Config::set('site_name', 'Speed dating');

Config::set('languages', array('ru', 'en'));

Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_'
));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'mainpage');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.host_for_PDO', 'mysql:host=127.0.0.1;dbname=sdating');
Config::set('db.user', 'mysql');
Config::set('db.password', 'mysql');
Config::set('db.db_name', 'mvc');

Config::set('salt', 'u8kswS333WUHdNnG');

