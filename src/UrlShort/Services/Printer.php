<?php

namespace Bisix21\src\UrlShort\Services;

class Printer
{
	protected static string $symbol = "=";
	protected static int $length = 60;

	public function __construct($symbol, $length)
	{
		self::$symbol = $symbol;
		self::$length = $length;
	}

	public static function printString(string $string): void
	{
		echo $string . "\n";
	}
	public static function printStringWithDivider(string $string): void
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
		foreach ($data as $key => $value) {
			echo $key . " => " . $value . "\n";
		}
		echo "\n";
	}
	public static function printArrayWithDivider(array $data, $key = true): void
	{
		if (!$key) {
			self::divider();
			self::noKey($data);
			self::divider();
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
		foreach ($data as $value) {
			echo $value . "\n";
		}
	}

	public static function nextLine(): void
	{
		echo "<br>";
	}
}