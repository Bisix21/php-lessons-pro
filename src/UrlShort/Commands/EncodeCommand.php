<?php

namespace Bisix21\src\UrlShort\Commands;

use Bisix21\src\Core\Config;
use Bisix21\src\UrlShort\Encode;
use Bisix21\src\UrlShort\Interface\CommandInterface;
use Bisix21\src\UrlShort\Interface\IUrlEncoder;
use Bisix21\src\UrlShort\Repository\AR;
use Bisix21\src\UrlShort\Repository\DM;
use Bisix21\src\UrlShort\Repository\Files;
use Bisix21\src\UrlShort\Services\Printer;
use Bisix21\src\UrlShort\Services\Converter;
use Bisix21\src\UrlShort\Services\Validator;

class EncodeCommand implements CommandInterface, IUrlEncoder
{

	public function __construct(
		protected Encode      $encode,
		protected Converter   $arguments,
		protected DM|AR|Files $record,
		protected Validator   $validator
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

	protected function saveAndPrint()
	{
		$codeShort = $this->createArr($this->encode($this->arguments->getArguments()), $this->arguments->getArguments());
		$this->record->saveToDb($codeShort);
		Printer::printString($codeShort['code'] . " => " . $codeShort['url']);
	}

	protected function createArr(string $code, string $url): array
	{
		return [
			'code' => $code,
			'url' => $url,
		];
	}

	public function encode(string $url): string
	{
		return substr(md5($url), 0, $this->getLength());
	}

	protected function getLength(): int
	{
		return Config::instance()->get('config.length');
	}
}