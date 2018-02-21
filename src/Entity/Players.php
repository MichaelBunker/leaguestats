<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 */
class Players
{
	/**
	 * Player primary key.
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $playerId;

	/**
	 * Player name.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $name;

	/**
	 * Team.
	 *
	 * @Groups({"public"})
	 * @ORM\ManyToOne(targetEntity="\App\Entity\Teams", fetch="EXTRA_LAZY")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
	 * })
	 */
	private $team;

	/**
	 * Position.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="string")
	 */
	private $position;

	/**
	 * Active.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * @return mixed
	 */
	public function getPlayerId()
	{
		return $this->playerId;
	}

	/**
	 * @param mixed $playerId
	 */
	public function setPlayerId($playerId)
	{
		$this->playerId = $playerId;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getTeam()
	{
		return $this->team;
	}

	/**
	 * @param mixed $team
	 */
	public function setTeam($team)
	{
		$this->team = $team;
	}

	/**
	 * @return mixed
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * @param mixed $position
	 */
	public function setPosition($position)
	{
		$this->position = $position;
	}

	/**
	 * @return mixed
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * @param mixed $active
	 */
	public function setActive($active)
	{
		$this->active = $active;
	}

}