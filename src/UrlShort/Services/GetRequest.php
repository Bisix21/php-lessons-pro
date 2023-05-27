<?php

namespace Bisix21\src\UrlShort\Services;

class GetRequest
{
	protected array $get;

	public function __construct()
	{
		$this->get = $_GET;
	}

	public function getDataFromGetRequest(): array
	{
		return $this->get;
	}
}