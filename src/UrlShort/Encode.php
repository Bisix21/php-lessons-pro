<?php

namespace Bisix21\src\UrlShort;


use Bisix21\src\UrlShort\Interface\IUrlEncoder;

class Encode implements IUrlEncoder
{

	private int $length;

	public function __construct(int $length)
	{
		$this->length = $length;
	}

	/**
	 * @inheritDoc
	 */
	public function encode(string $url): string
	{

	}
}