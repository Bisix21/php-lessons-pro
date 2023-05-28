<?php

namespace Bisix21\src\Commands;

use Bisix21\src\Classes\Divider;
use Bisix21\src\Core\Converter;
use Bisix21\src\Core\Validator;
use Bisix21\src\Interface\CommandInterface;
use Bisix21\src\Repository\DB;
use Bisix21\src\Repository\Files;
use Bisix21\src\UrlShort\Encode;
use InvalidArgumentException;

class EncodeCommand  implements CommandInterface
{

	public function __construct(
		protected Encode    $encode,
		protected Converter $arguments,
		protected DB|Files  $record,
		protected Validator $validator
	)
	{
	}

	public function runAction(): void
	{
		//валідує лінк
		$this->validator->link($this->arguments->getArguments());
		$this->issetCodeInDB();
		//записує в бд
		$this->saveAndPrint();
	}
// TODO: перенести метод issetCodeInDB($this->encodeUrl()) в модель Short
	protected function issetCodeInDB()
	{
		$res = $this->validator->issetCode($this->encodeUrl());
		if (!$res) {
			throw new InvalidArgumentException("You have same record: {$this->encodeUrl()} => {$this->arguments->getArguments()}");
		}
	}

	protected function encodeUrl(): string
	{
		return $this->encode->encode($this->arguments->getArguments());
	}

	protected function saveAndPrint()
	{
		$codeShort = $this->createArr($this->encodeUrl(), $this->arguments->getArguments());
		$this->record->saveToDb($codeShort);
		Divider::printString($codeShort['code'] . " => " . $codeShort['url']);
	}

	protected function createArr(string $code, string $url): array
	{
		return [
			'code' => $code,
			'url' => $url,
		];
	}
}