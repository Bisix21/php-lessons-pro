<?php

namespace Classes;

use Interface\IUrlEncoder;


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
		 return substr( md5($url), 0 , $this->length);
	}
}