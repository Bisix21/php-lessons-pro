<?php

use Bisix21\src\Core\Config;

require_once ROOT . "vendor/autoload.php";

Config::instance(
	array_merge([
			"services" => require_once ROOT . "config/services.php",
			"config" => require_once ROOT . "config/config.php",
			"commands" => require_once ROOT . "config/commands.php",
		]
	)
);
