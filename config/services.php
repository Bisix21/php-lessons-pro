<?php

use Bisix21\src\Core\Command;
use Bisix21\src\Core\Config;
use Bisix21\src\Core\Handler;
use Bisix21\src\ORM\ActiveRecord;
use Bisix21\src\UrlShort\Commands\DecodeCommand;
use Bisix21\src\UrlShort\Commands\DefaultCommands;
use Bisix21\src\UrlShort\Commands\EncodeCommand;
use Bisix21\src\UrlShort\Decode;
use Bisix21\src\UrlShort\Encode;
use Bisix21\src\UrlShort\Entity\Short;
use Bisix21\src\UrlShort\ORM\DataMapper;
use Bisix21\src\UrlShort\ORM\Models\UrlShort;
use Bisix21\src\UrlShort\Repository\AR;
use Bisix21\src\UrlShort\Repository\DM;
use Bisix21\src\UrlShort\Repository\Files;
use Bisix21\src\UrlShort\Services\Converter;
use Bisix21\src\UrlShort\Services\GetRequest;
use Bisix21\src\UrlShort\Services\Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return [
	Handler::class => function ($container) {
		return new Handler(
			$container->get(Converter::class),
			$container->get(Command::class),
			$container->get(ActiveRecord::class),
		);
	},
	//Helpers
	Config::class => function () {
		return Config::instance();
	},
	Converter::class => function ($container) {
		return new Converter(
			$container->get(Validator::class),
			$container->get(GetRequest::class)
		);
	},
	Validator::class => function ($container) {
		return new Validator(
			$container->get(Config::class)->get('commands'),
			$container->get(UrlShort::class)
		);
	},
	GetRequest::class => function () {
		return new GetRequest();
	},
	//functional
	Encode::class => function ($container) {
		return new Encode(
			$container->get(Config::class)->get("config.length"));
	},
	Decode::class => function ($container) {
		return new Decode(
			$container->get(DataMapper::class)->getEM()
		);
	},
	//command
	Command::class => function ($container) {
		return new Command(
			$container->get(Validator::class)
		);
	},
	DefaultCommands::class => function ($container) {
		return new DefaultCommands(
			$container->get(Validator::class)
		);
	},
	EncodeCommand::class => function ($container) {
		return new EncodeCommand(
			$container->get(Encode::class),
			$container->get(Converter::class),
			$container->get(DM::class),
			$container->get(Validator::class)
		);
	},
	DecodeCommand::class => function ($container) {
		return new DecodeCommand(
			$container->get(Decode::class),
			$container->get(DM::class),
			$container->get(Converter::class),
			$container->get(Validator::class)
		);
	},
	//logger
	Logger::class => function ($container) {
		$log = new Logger("log");
		$log->pushHandler($container->get(StreamHandler::class));
		return $log;
	},
	StreamHandler::class => function ($container) {
		return new StreamHandler($container->get(Config::class)->get("config.logs"));
	},
	//Storages
	Files::class => function ($container) {
		return new Files($container->get(Config::class)->get("config.urls"));
	},
	ActiveRecord::class => function ($container) {
		$configDbConnection = $container->get(Config::class)->get('config.db_connection.active_record');
		return new ActiveRecord($configDbConnection);
	},
	DataMapper::class => function ($container) {
		$configDbConnection = $container->get(Config::class)->get('config.db_connection.data_mapper');
		return new DataMapper($configDbConnection);
	},
	//models
	UrlShort::class => function () {
		return new UrlShort();
	},
	//connect Storage and Action
	AR::class => function ($container) {
		return new AR($container->get(UrlShort::class));
	},
	DM::class => function ($container) {
		return new DM(
			$container->get(Decode::class),
			$container->get(Short::class),
			$container->get(DataMapper::class)->getEM()
		);
	},
	//entity
	Short::class => function () {
		return new Short();
	},
];