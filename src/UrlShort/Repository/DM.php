<?php

namespace Bisix21\src\UrlShort\Repository;

use Bisix21\src\UrlShort\Decode;
use Bisix21\src\UrlShort\Entity\Repository\ShortRepository;
use Bisix21\src\UrlShort\Entity\Short;
use Bisix21\src\UrlShort\Interface\DBInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use InvalidArgumentException;

class DM implements DBInterface
{
	public function __construct(
		protected Decode        $decode,
		protected Short         $short,
		protected EntityManager $entityManager,
	)
	{
	}

	/**
	 * @throws ORMException
	 */
	public function saveToDb($data): void
	{
		$shortRep = $this->entityManager->getRepository(Short::class);
		if (!$shortRep->issetCode($data['code'])) {
			throw new InvalidArgumentException("You have same record: {$data['code']} => {$data['url']}");
		}
		$this->short->setCode($data['code']);
		$this->short->setUrl($data['url']);
		$this->entityManager->persist($this->short);
		$this->entityManager->flush();
	}

	public function read(string $code): string
	{
		/** @var ShortRepository $shortRep */
		$shortRep = $this->entityManager->getRepository(Short::class);
		$short = $shortRep->getUrlByCode($code);
		if (is_null($short)) {
			throw new InvalidArgumentException(" Undefined code $code");
		}
		return $this->decode->decode($short->getCode());
	}
}