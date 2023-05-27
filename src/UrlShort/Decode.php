<?php

namespace Bisix21\src\UrlShort;

use Bisix21\src\UrlShort\Interface\IUrlDecoder;


class Decode implements IUrlDecoder
{
	public function __construct(
	)
	{
	}

	public function decode(string $code): string
	{
		return  "decode";
	}
}