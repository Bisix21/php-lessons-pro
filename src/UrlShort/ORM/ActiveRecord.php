<?php

namespace Bisix21\src\ORM;

use Illuminate\Database\Capsule\Manager;

class ActiveRecord
{
	public function __construct(
		public array $configDbConnection,
	)
	{
		$this->connectToDB();
	}

	public function connectToDB(): void
	{
		$manager = new Manager();
		$manager->addConnection($this->configDbConnection);
		$manager->setAsGlobal();
		$manager->bootEloquent();
	}
}