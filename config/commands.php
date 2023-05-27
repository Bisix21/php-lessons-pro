<?php

use Bisix21\src\UrlShort\Commands\DecodeCommand;
use Bisix21\src\UrlShort\Commands\DefaultCommands;
use Bisix21\src\UrlShort\Commands\EncodeCommand;

return [
	'allowed:encode' => EncodeCommand::class,
	'allowed:decode' => DecodeCommand::class,
	'allowed:help' => DefaultCommands::class,
];