<?php

namespace Bisix21\src\UrlShort\Commands;

use Bisix21\src\Classes\Divider;
use Bisix21\src\Core\Converter;
use Bisix21\src\Core\Validator;
use Bisix21\src\Interface\CommandInterface;
use Bisix21\src\UrlShort\Encode;
use Bisix21\src\UrlShort\Repository\AR;
use Bisix21\src\UrlShort\Repository\DM;
use Bisix21\src\UrlShort\Repository\Files;

class EncodeCommand  implements CommandInterface
{

	public function __construct(
		protected Encode    $encode,
		protected Converter $arguments,
		protected DM|AR|Files  $record,
		protected Validator $validator
	)
	{
	}

	public function runAction(): void
	{
		//валідує лінк
		$this->validator->link($this->arguments->getArguments());
		//записує в бд
		$this->saveAndPrint();
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