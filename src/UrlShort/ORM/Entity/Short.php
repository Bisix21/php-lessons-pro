<?php

namespace Bisix21\src\UrlShort\Entity;

use Bisix21\src\UrlShort\Entity\Repository\ShortRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShortRepository::class)]
class Short
{
	#[ORM\Id]
	#[ORM\Column(type: Types::INTEGER)]
	#[ORM\GeneratedValue]
	private int $id;
	#[ORM\Column(type: Types::TEXT, nullable: false)]
	private string $code;
	#[ORM\Column(type: Types::TEXT, nullable: false)]
	private string $url;

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param string $code
	 */
	public function setCode(string $code): void
	{
		$this->code = $code;
	}

	/**
	 * @param string $url
	 */
	public function setUrl(string $url): void
	{
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}
}