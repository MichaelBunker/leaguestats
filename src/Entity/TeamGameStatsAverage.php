<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity for TeamGameStatsAverage.
 */
class TeamGameStatsAverage
{
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
	 * First Blood.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstBlood;

	/**
	 * Win percentage.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $winPercentage;

	/**
	 * Average kills per game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $kills;

	/**
	 * Average assists per game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $assists;

	/**
	 * Average deaths per game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $deaths;

	/**
	 * Average wards placed per game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $wardsPlaced;

	/**
	 * Average damage dealt per game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $damageDealt;

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
	public function getFirstBlood()
	{
		return $this->firstBlood;
	}

	/**
	 * @param mixed $firstBlood
	 */
	public function setFirstBlood($firstBlood)
	{
		$this->firstBlood = $firstBlood;
	}

	/**
	 * @return mixed
	 */
	public function getWinPercentage()
	{
		return $this->winPercentage;
	}

	/**
	 * @param mixed $winPercentage
	 */
	public function setWinPercentage($winPercentage)
	{
		$this->winPercentage = $winPercentage;
	}

	/**
	 * @return mixed
	 */
	public function getKills()
	{
		return $this->kills;
	}

	/**
	 * @param mixed $kills
	 */
	public function setKills($kills)
	{
		$this->kills = $kills;
	}

	/**
	 * @return mixed
	 */
	public function getAssists()
	{
		return $this->assists;
	}

	/**
	 * @param mixed $assists
	 */
	public function setAssists($assists)
	{
		$this->assists = $assists;
	}

	/**
	 * @return mixed
	 */
	public function getDeaths()
	{
		return $this->deaths;
	}

	/**
	 * @param mixed $deaths
	 */
	public function setDeaths($deaths)
	{
		$this->deaths = $deaths;
	}

	/**
	 * @return mixed
	 */
	public function getWardsPlaced()
	{
		return $this->wardsPlaced;
	}

	/**
	 * @param mixed $wardsPlaced
	 */
	public function setWardsPlaced($wardsPlaced)
	{
		$this->wardsPlaced = $wardsPlaced;
	}

	/**
	 * @return mixed
	 */
	public function getDamageDealt()
	{
		return $this->damageDealt;
	}

	/**
	 * @param mixed $damageDealt
	 */
	public function setDamageDealt($damageDealt)
	{
		$this->damageDealt = $damageDealt;
	}
}
