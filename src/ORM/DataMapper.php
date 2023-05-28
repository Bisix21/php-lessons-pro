<?php

namespace Bisix21\src\ORM;

use Bisix21\src\Interface\DataBaseConnectionInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

class DataMapper implements DataBaseConnectionInterface
{

	protected ?EntityManager $em ;
	protected Configuration $config;
	protected Connection $connection;

	/**
	 * @throws Exception
	 */
	public function __construct(
		protected array $configDbConnection
	)
	{
		$this->connectToDB();
	}

	/**
	 * @throws Exception
	 */
	public function connectToDB(): void
	{
		if (empty($this->configDbConnection['entity_path'])) {
			throw new Exception("Set path to entity");
		}
		$this->config = ORMSetup::createAttributeMetadataConfiguration(
			$this->configDbConnection['entity_path'],
			$this->configDbConnection['dev_mode']
		);
		$this->connection = DriverManager::getConnection($this->configDbConnection['db_connection'], $this->config);
	}


	/**
	 * @throws MissingMappingDriverImplementation
	 */
	public function getEM(): EntityManager
	{
		return new EntityManager($this->connection, $this->config);
	}

}