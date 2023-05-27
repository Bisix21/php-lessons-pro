<?php

return [
	'urls' => ROOT . "storage/urlNew.json",
	'logs' => ROOT . "storage/newLogger.log",
	'length' => 10,
	'db_connection' => [
		'active_record' => [
			'driver' => 'mysql',
			'host' => 'db_mysql',
			'database' => 'php_pro',
			'username' => 'Bisix21',
			'password' => 'password',
			'port' => 3306
		],
		'data_mapper' => [
			"db_connection" => [
				'dbname' => 'php_pro',
				'user' => 'Bisix21',
				'password' => 'password',
				'driver' => 'pdo_mysql',
				'host' => 'db_mysql',
				'port' => 3306
			],
			'dev_mode' => true,
			"entity_path" => [
				ROOT . "src/Entity"
			]
		]
	],

];