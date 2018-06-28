<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="team_game_stats")
 */
class TeamGameStats
{
	/**
	 * Team Game Stats primary key.
	 *
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $teamGameStatId;

	/**
	 * Team.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
	 */
	private $team;

	/**
	 * Game.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Games")
	 * @ORM\JoinColumn(name="game_id", referencedColumnName="game_id")
	 */
	private $game;

	/**
	 * First Blood.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstBlood;

	/**
	 * First tower.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstTower;

	/**
	 * First inhibitor.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstInhibitor;

	/**
	 * First baron.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstBaron;

	/**
	 * First Drake.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstDrake;

	/**
	 * First rift herald.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $riftHerald;

	/**
	 * First elder drake.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstElderDrake;

	/**
	 * Total number of drakes.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalDrakes;

	/**
	 * Total number of towers.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalTowers;

	/**
	 * Total number of inhibitors.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalInhibitors;

	/**
	 * Total number of barons.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalBarons;

	/**
	 * bans.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="array_champions")
	 */
	private $bans;

	/**
	 * @return mixed
	 */
	public function getTeamGameStatId()
	{
		return $this->teamGameStatId;
	}

	/**
	 * @param mixed $teamGameStatId
	 */
	public function setTeamGameStatId($teamGameStatId)
	{
		$this->teamGameStatId = $teamGameStatId;
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
	public function getGame()
	{
		return $this->game;
	}

	/**
	 * @param mixed $game
	 */
	public function setGame($game)
	{
		$this->game = $game;
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
	public function getFirstTower()
	{
		return $this->firstTower;
	}

	/**
	 * @param mixed $firstTower
	 */
	public function setFirstTower($firstTower)
	{
		$this->firstTower = $firstTower;
	}

	/**
	 * @return mixed
	 */
	public function getFirstInhibitor()
	{
		return $this->firstInhibitor;
	}

	/**
	 * @param mixed $firstInhibitor
	 */
	public function setFirstInhibitor($firstInhibitor)
	{
		$this->firstInhibitor = $firstInhibitor;
	}

	/**
	 * @return mixed
	 */
	public function getFirstBaron()
	{
		return $this->firstBaron;
	}

	/**
	 * @param mixed $firstBaron
	 */
	public function setFirstBaron($firstBaron)
	{
		$this->firstBaron = $firstBaron;
	}

	/**
	 * @return mixed
	 */
	public function getRiftHerald()
	{
		return $this->riftHerald;
	}

	/**
	 * @param mixed $riftHerald
	 */
	public function setRiftHerald($riftHerald)
	{
		$this->riftHerald = $riftHerald;
	}

	/**
	 * @return mixed
	 */
	public function getFirstElderDrake()
	{
		return $this->firstElderDrake;
	}

	/**
	 * @param mixed $firstElderDrake
	 */
	public function setFirstElderDrake($firstElderDrake)
	{
		$this->firstElderDrake = $firstElderDrake;
	}

	/**
	 * @return mixed
	 */
	public function getTotalDrakes()
	{
		return $this->totalDrakes;
	}

	/**
	 * @param mixed $totalDrakes
	 */
	public function setTotalDrakes($totalDrakes)
	{
		$this->totalDrakes = $totalDrakes;
	}

	/**
	 * @return mixed
	 */
	public function getTotalTowers()
	{
		return $this->totalTowers;
	}

	/**
	 * @param mixed $totalTowers
	 */
	public function setTotalTowers($totalTowers)
	{
		$this->totalTowers = $totalTowers;
	}

	/**
	 * @return mixed
	 */
	public function getTotalInhibitors()
	{
		return $this->totalInhibitors;
	}

	/**
	 * @param mixed $totalInhibitors
	 */
	public function setTotalInhibitors($totalInhibitors)
	{
		$this->totalInhibitors = $totalInhibitors;
	}

	/**
	 * @return mixed
	 */
	public function getTotalBarons()
	{
		return $this->totalBarons;
	}

	/**
	 * @param mixed $totalBarons
	 */
	public function setTotalBarons($totalBarons)
	{
		$this->totalBarons = $totalBarons;
	}

	/**
	 * @return bool
	 */
	public function isFirstDrake()
	{
		return $this->firstDrake;
	}

	/**
	 * @param bool $firstDrake
	 */
	public function setFirstDrake($firstDrake)
	{
		$this->firstDrake = $firstDrake;
	}

	/**
	* @param array $bans
	*/
	public function getBans()
	{
		return $this->bans;
	}

	/**
	* @param array $bans
	*/
	public function setBans($bans)
	{
		$this->bans = $bans;
	}
}
