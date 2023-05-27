<?php

use Bisix21\src\Core\Config;
use Bisix21\src\Core\DI\Container;
use Bisix21\src\Core\Handler;
use Bisix21\src\UrlShort\Service\Divider;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

const ROOT = __DIR__ . "/../";
require_once ROOT . "src/bootstrap.php";
$services = Config::instance()->get("services");
try {
	/**
	 * @var Logger $monolog
	 **/
	Container::getInstance($services);
	$monolog = Container::getInstance()->get(Logger::class);
	$handle = Container::getInstance()->get(Handler::class);
	/** @var Handler $handle */
	$handle->handle();
} catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
	Divider::printString($e->getMessage() . $e->getFile());
	$monolog->error($e->getMessage() . $e->getFile());
} catch (InvalidArgumentException $argumentException) {
	Divider::printString($argumentException->getMessage());
	$monolog->info($argumentException->getMessage());
}