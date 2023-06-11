<?php

namespace Bisix21\src\UrlShort\Commands;

use Bisix21\src\UrlShort\Interface\CommandInterface;
use Bisix21\src\UrlShort\Services\Printer;
use Bisix21\src\UrlShort\Services\Validator;

class DefaultCommands implements CommandInterface
{
	public function __construct(
		protected Validator $validator
	)
	{
	}

	public function runAction(): void
	{
		$this->commandCLI();
	}

	protected function commandCLI()
	{
		Printer::printString("Allowed commands:");
		Printer::printArray(array_keys($this->validator->allowedCommands()), false);
	}

	protected function commandWEB()
	{

		Printer::printString("<br> for start: <br> after {$_SERVER['HTTP_HOST']} write: <br>
 						?command=encode&url=https://laravel.com <br>
 						or for decode <br>
 						?command=decode&code=f88faf1230 <br>
					where <b>encode</b> is command and can change from list down (help is default): ");
		Printer::nextLine();
		Printer::printArray(array_keys($this->validator->allowedCommands()), false);
	}
}