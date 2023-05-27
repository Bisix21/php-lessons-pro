<?php

namespace Bisix21\src\Core;

use Bisix21\src\Classes\Divider;
use Bisix21\src\Core\DI\Container;
use Bisix21\src\UrlShort\Services\Validator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Command
{
	public function __construct(
		protected Validator $validator
	)
	{
	}

	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function run($givenCommand): void
	{
		foreach ($this->validator->allowedCommands() as $key => $command) {
			if ($givenCommand === $key ) {
				Container::getInstance()->get($command)->runAction();
			}
		}
	}
}