<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="games")
 */
class Games
{
	/**
	 * Games primary key.
	 *
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $gameId;

	/**
	 * Red team.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="red_team", referencedColumnName="team_id")
	 */
	private $redTeam;

	/**
	 * Blue team.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="blue_team", referencedColumnName="team_id")
	 */
	private $blueTeam;

	/**
	 * Duration of game.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $duration;

	/**
	 * Winning team.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="winner", referencedColumnName="team_id")
	 */
	private $winner;

	/**
	 * Match game took place in.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Matches")
	 * @ORM\JoinColumn(name="match_id", referencedColumnName="match_id")
	 */
	private $match;

	/**
	 * @return mixed
	 */
	public function getGameId()
	{
		return $this->gameId;
	}

	/**
	 * @param mixed $gameId
	 */
	public function setGameId($gameId)
	{
		$this->gameId = $gameId;
	}

	/**
	 * @return mixed
	 */
	public function getRedTeam()
	{
		return $this->redTeam;
	}

	/**
	 * @param mixed $redTeam
	 */
	public function setRedTeam($redTeam)
	{
		$this->redTeam = $redTeam;
	}

	/**
	 * @return mixed
	 */
	public function getBlueTeam()
	{
		return $this->blueTeam;
	}

	/**
	 * @param mixed $blueTeam
	 */
	public function setBlueTeam($blueTeam)
	{
		$this->blueTeam = $blueTeam;
	}

	/**
	 * @return mixed
	 */
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * @return mixed
	 */
	public function getWinner()
	{
		return $this->winner;
	}

	/**
	 * @param mixed $winner
	 */
	public function setWinner($winner)
	{
		$this->winner = $winner;
	}

	/**
	 * @return mixed
	 */
	public function getMatch()
	{
		return $this->match;
	}

	/**
	 * @param mixed $match
	 */
	public function setMatch($match)
	{
		$this->match = $match;
	}
}
