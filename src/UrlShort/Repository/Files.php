<?php

namespace Bisix21\src\UrlShort\Repository;

use Bisix21\src\Interface\DBInterface;
use InvalidArgumentException;

class Files implements DBInterface
{
	protected array $dataArray;

	public function __construct(
		protected string $pathUrls
	)
	{
	}

	public function read(string $code): string|null
	{
		if (!file_exists($this->pathUrls)) {
			file_put_contents($this->pathUrls, '');
			throw new InvalidArgumentException('File don\'t exist, rerun code');
		}
		$data = file_get_contents($this->pathUrls);
		return $this->dataArray = json_decode($data, true) ?? [];
	}

	public function saveToDB($data): void
	{
		$this->dataArray[$data['code']] =  $data['url'];
		if (!empty($data)) {
			$data = json_encode($this->dataArray, JSON_PRETTY_PRINT);
			file_put_contents($this->pathUrls, $data);
		}
	}
}