<?php

namespace Bisix21\src\UrlShort\Interface;

use InvalidArgumentException;

interface DBInterface
{

	/**
	 * @return array|null
	 * @throws InvalidArgumentException
	 */
	public function read(string $code): string|null;

	/**
	 * @array $data
	 * @throws InvalidArgumentException
	 */
	public function saveToDB(array $data): void;

}