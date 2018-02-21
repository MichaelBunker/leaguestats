<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="champions")
 */
class Champions
{
	/**
	 * Champion primary key.
	 *
	 * @var integer
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $championId;

	/**
	 * champion name.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $name;

	/**
	 * champion label.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $label;

	/**
	 * Champion full name.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $fullName;

	/**
	 * @return int
	 */
	public function getChampionId()
	{
		return $this->championId;
	}

	/**
	 * @param int $championId
	 */
	public function setChampionId($championId)
	{
		$this->championId = $championId;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label)
	{
		$this->label = $label;
	}

	/**
	 * @return string
	 */
	public function getFullName()
	{
		return $this->fullName;
	}

	/**
	 * @param string $fullName
	 */
	public function setFullName($fullName)
	{
		$this->fullName = $fullName;
	}
}
