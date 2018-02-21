<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity representing an LCS Team.
 *
 * @ORM\Entity
 * @ORM\Table(name="teams")
 */
class Teams
{
	/**
	 * Teams primary key.
	 *
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $teamId;

	/**
	 * Team organization.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $organization;

	/**
	 * Abbreviation.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string")
	 */
	private $abbr;

	/**
	 * Region team plays in.
	 *
	 * @var string
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=10)
	 */
	private $region;

	/**
	 * @return mixed
	 */
	public function getTeamId()
	{
		return $this->teamId;
	}

	/**
	 * @param mixed $teamId
	 */
	public function setTeamId($teamId)
	{
		$this->teamId = $teamId;
	}

	/**
	 * @return string
	 */
	public function getOrganization()
	{
		return $this->organization;
	}

	/**
	 * @param string $organization
	 */
	public function setOrganization($organization)
	{
		$this->organization = $organization;
	}

	/**
	 * @return string
	 */
	public function getAbbr()
	{
		return $this->abbr;
	}

	/**
	 * @param string $abbr
	 */
	public function setAbbr($abbr)
	{
		$this->abbr = $abbr;
	}

	/**
	 * @return string
	 */
	public function getRegion()
	{
		return $this->region;
	}

	/**
	 * @param string $region
	 */
	public function setRegion($region)
	{
		$this->region = $region;
	}
}
