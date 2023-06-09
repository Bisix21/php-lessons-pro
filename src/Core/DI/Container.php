<?php

namespace Bisix21\src\Core\DI;

use DiggPHP\Psr11\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
	private static ?Container $instance = null;
	private array $dependencies;

	private function __construct($dependencies = [])
	{
		$this->dependencies = $dependencies;
	}

	public static function getInstance($dependencies = []): self
	{
		if (null === self::$instance) {
			self::$instance = new self($dependencies);
		}
		return self::$instance;
	}

	public function get($id)
	{
		if (!$this->has($id)) {
			throw new NotFoundException("Dependency {$id} not found");
		}

		$dependency = $this->dependencies[$id];

		if (is_callable($dependency)) {
			return $dependency($this);
		}

		return $dependency;
	}

	public function has($id): bool
	{
		return array_key_exists($id, $this->dependencies);
	}
}