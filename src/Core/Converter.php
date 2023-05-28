<?php

namespace Bisix21\src\Core;

use Bisix21\src\Classes\GetRequest;

class Converter
{
	protected string $command;
	protected string|array $arguments;

	public function __construct(
		protected Validator  $validator,
		protected GetRequest $getRequest
	)
	{
	}

	public function commandCall(): string
	{
		global $argv;
		if (!empty($argv)) {
			$this->command = $this->prepareCommand($argv);
		}
		if (!empty($_GET)) {
			$this->command = $this->prepareCommand($this->getRequest->getDataFromGetRequest()['command']);
		}
		return $this->command;
	}

	protected function prepareCommand($dataForCommand): array|string
	{
		if (is_array($dataForCommand)) {
			if (!empty($dataForCommand)) {
				$dataForCommand = array_slice($dataForCommand, 1);
				$this->validator->validateCommand($dataForCommand[0]);
			}
		}
		return $dataForCommand; //отримуємо команду}
	}

	public function getArguments()
	{
		if (!empty($argv)) {
			$this->arguments = $this->prepareArgument($argv);
		}
		if (!empty($_GET)) {
			$this->arguments = $this->prepareArgument($this->getRequest->getDataFromGetRequest());
		}
		return $this->arguments;

	}

	protected function prepareArgument($dataForArguments)
	{
		if (is_array($dataForArguments)) {
			if (!empty($dataForArguments)) {
				$dataForArguments = array_slice($dataForArguments, 1); // отримуємо аргументи (сайт або код)
			}
		}
		return $dataForArguments;
	}

}