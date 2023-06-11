<?php

namespace Bisix21\src\UrlShort;


use Bisix21\src\Core\Config;
use Bisix21\src\UrlShort\Interface\IUrlEncoder;

class Encode implements IUrlEncoder
{

	private int $length;

	public function __construct()
	{
		$this->length = Config::instance()->get('config.length');
	}

	/**
	 * @inheritDoc
	 */
	public function encode(string $url): string
	{
		return substr(md5($url), 0, $this->length);
	}
}