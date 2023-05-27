<?php

namespace Bisix21\src\UrlShort\Commands;

use Bisix21\src\Classes\Divider;
use Bisix21\src\Core\Validator;
use Bisix21\src\Interface\CommandInterface;

class DefaultCommands implements CommandInterface
{
	public function __construct(
		protected Validator $validator
	)
	{
	}

	public function runAction(): void
	{
		Divider::printString("<br> for start: <br> after {$_SERVER['HTTP_HOST']} write: <br>
 						?command=encode&url=https://laravel.com <br>
 						or for decode <br>
 						?command=decode&code=f88faf1230 <br>
					where <b>encode</b> is command and can change from list down (help is default): ");
		Divider::nextLine();
		Divider::printArray(array_keys($this->validator->allowedCommands()), false);
	}
}