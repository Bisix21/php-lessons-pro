<?php

namespace Bisix21\src\UrlShort\Services;

use Bisix21\src\UrlShort\ORM\Models\UrlShort;
use InvalidArgumentException;

class Validator
{
	protected bool $status = true;

	public function __construct(
		protected array    $allCommands,
		protected UrlShort $short
	)
	{
	}

	public function link($link): bool|int
	{
		// прротокол + доменна назва . домен : порт(якщо існує)/ назва каталогу
		$pattern = '/^https?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})(:[0-9]{1,5})?(\/.*)?$/i';
		if (is_array($link)){
			$link = $link['url'];
		}
		$this->isEmpty($link);
		$res = preg_match($pattern, $link);
		if (!$res) {
			throw new InvalidArgumentException("Invalid url: $link");
		}
		return $res;
	}

	public function isEmpty($value): bool
	{
		if (empty($value)) {
			$this->status = false;
			throw new InvalidArgumentException("Invalid argument!");
		}
		return $this->status;
	}
	public function validateCommand($command): string
	{
		if ($command == null) {
			$this->invalidArgument();
		}
		if (array_keys($this->allowedCommands(), $command)) {
			$this->invalidArgument();
		}
		return $command;
	}

	protected function invalidArgument()
	{
		throw new InvalidArgumentException("Not found command. Print help to see all commands");
	}

	public function allowedCommands(): array
	{
		$allowed = [];
		foreach ($this->allCommands as $key => $command) {
			$key = explode(":", $key);
			if (strtolower($key[0]) == "allowed") {
				$allowed[$key[1]] = $command;
			}
		}
		return $allowed;
	}

}