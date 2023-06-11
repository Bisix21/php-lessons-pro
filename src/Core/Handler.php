<?php

namespace Bisix21\src\Core;

use Bisix21\src\UrlShort\ORM\ActiveRecord;
use Bisix21\src\UrlShort\Services\Converter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Handler
{
	protected string $givenCommand;

	public function __construct(
		protected Converter $converter,
		protected Command   $command,
		protected ActiveRecord $connect,
	)
	{
	}

	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function handle(): void
	{
		$this->connect->connectToDB();
		$this->givenCommand = $this->converter->commandCall();
		$this->command->run($this->givenCommand);
	}
}