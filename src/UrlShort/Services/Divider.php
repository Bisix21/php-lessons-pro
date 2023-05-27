<?php

namespace Bisix21\src\UrlShort\Service;

class Divider
{
	protected static string $symbol = "=";
	protected static int $length = 0;

	public function __construct($symbol, $length)
	{
		self::$symbol = $symbol;
		self::$length = $length;
	}

	public static function printString(string $string): void
	{
		self::divider();
		echo $string . "\n";
		self::divider();
		echo "\n";
	}

	protected static function divider(): void
	{
		for ($i = 0; $i < self::$length; $i++) {
			echo self::$symbol;
		}
		echo "\n";
	}

	public static function printArray(array $data, $key = true): void
	{
		if (!$key) {
			self::noKey($data);
			exit();
		}
		self::divider();
		foreach ($data as $key => $value) {
			echo $key . " => " . $value . "\n";
		}
		self::divider();
		echo "\n";
	}

	protected static function noKey($data): void
	{
		self::divider();
		foreach ($data as $value) {
			echo $value . "\n";
		}
		self::divider();
	}

	public static function nextLine(): void
	{
		echo "<br>";
	}
}