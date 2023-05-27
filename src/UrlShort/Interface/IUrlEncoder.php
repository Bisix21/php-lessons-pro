<?php

namespace  Bisix21\src\UrlShort\Interface;

use InvalidArgumentException;

interface IUrlEncoder
{

	/**
	 * @param string $url
	 * @throws InvalidArgumentException
	 * @return string
	 */
	public function encode(string $url): string;
}

