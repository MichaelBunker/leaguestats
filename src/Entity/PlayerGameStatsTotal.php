<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entity for PlayerGameStatsTotal view.
 *
 * //TODO Fields are identical to average entity. Look into making this DRYer.
 *
 * @ORM\Entity
 * @ORM\Table(name="stats.player_game_stats_total")
 */
class PlayerGameStatsTotal
{
	/**
	 * Player.
	 *
	 * @ORM\Id
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Players")
	 * @ORM\JoinColumn(name="player_id", referencedColumnName="player_id")
	 */
	private $player;

	/**
	 * Total kills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $kills;

	/**
	 * Total assists.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $assists;

	/**
	 * Total deaths.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $deaths;

	/**
	 * Total wards placed.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $wardsPlaced;

	/**
	 * total damage dealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $damageDealt;

	/**
	 * total gold earned.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $gold;

	/**
	 * Total creep score.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $creepScore;

	/**
	 * Total vision score.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="float")
	 */
	private $visionScore;

	/**
	 * @return mixed
	 */
	public function getPlayer()
	{
		return $this->player;
	}

	/**
	 * @param mixed $player
	 */
	public function setPlayer($player)
	{
		$this->player = $player;
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

	/**
	 * @return mixed
	 */
	public function getGold()
	{
		return $this->gold;
	}

	/**
	 * @param mixed $gold
	 */
	public function setGold($gold)
	{
		$this->gold = $gold;
	}

	/**
	 * @return mixed
	 */
	public function getCreepScore()
	{
		return $this->creepScore;
	}

	/**
	 * @param mixed $creepScore
	 */
	public function setCreepScore($creepScore)
	{
		$this->creepScore = $creepScore;
	}

	/**
	 * @return mixed
	 */
	public function getVisionScore()
	{
		return $this->visionScore;
	}

	/**
	 * @param mixed $visionScore
	 */
	public function setVisionScore($visionScore)
	{
		$this->visionScore = $visionScore;
	}
}
