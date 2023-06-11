<?php

namespace Bisix21\src\UrlShort\Commands;

use Bisix21\src\UrlShort\Decode;
use Bisix21\src\UrlShort\Interface\CommandInterface;
use Bisix21\src\UrlShort\Repository\AR;
use Bisix21\src\UrlShort\Repository\DM;
use Bisix21\src\UrlShort\Repository\Files;
use Bisix21\src\UrlShort\Services\Printer;
use Bisix21\src\UrlShort\Services\Converter;
use Bisix21\src\UrlShort\Services\Validator;

class DecodeCommand  implements CommandInterface
{
	/**
	 * @param Decode $decoder
	 * @param DM|AR|Files $record
	 * @param Converter $arguments
	 * @param Validator $validator
	 */
	public function __construct(
		protected Decode      $decoder,
		protected DM|AR|Files $record,
		protected Converter   $arguments,
		protected Validator   $validator
	)
	{
	}

	public function runAction(): void
	{
		$this->issetCodeInDB();
		Printer::printString($this->decoder->decode($this->arguments->getArguments()));
	}

	protected function issetCodeInDB(): void
	{
		$this->validator->isEmpty($this->record->read($this->arguments->getArguments()));
	}
}