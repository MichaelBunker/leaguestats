<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="matches")
 */
class Matches
{
	/**
	 * Match primary key.
	 *
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $matchId;

	/**
	 * Season.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $season;

	/**
	 * Week.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $week;

	/**
	 * Split.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $split;

	/**
	 * Winner.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="winner", referencedColumnName="team_id")
	 */
	private $winner;

	/**
	 * Loser.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Teams")
	 * @ORM\JoinColumn(name="loser", referencedColumnName="team_id")
	 */
	private $loser;

	/**
	 * Number of games.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $bestOf;

	/**
	 * Date played.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(name="date_played", type="datetime")
	 */
	private $datePlayed;

	/**
	 * Tie breaker match.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(name="tie_breaker", type="boolean")
	 */
	private $tieBreaker;

	/**
	 * Tournament.
	 *
	 * if value exists, this match was played in matching tournament.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $tournament;

	/**
	 * Split.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="string", length=100)
	 */
	private $tournamentRound;

	/**
	 * @return mixed
	 */
	public function getMatchId()
	{
		return $this->matchId;
	}

	/**
	 * @param mixed $matchId
	 */
	public function setMatchId($matchId)
	{
		$this->matchId = $matchId;
	}

	/**
	 * @return mixed
	 */
	public function getSeason()
	{
		return $this->season;
	}

	/**
	 * @param mixed $season
	 */
	public function setSeason($season)
	{
		$this->season = $season;
	}

	/**
	 * @return mixed
	 */
	public function getWeek()
	{
		return $this->week;
	}

	/**
	 * @param mixed $week
	 */
	public function setWeek($week)
	{
		$this->week = $week;
	}

	/**
	 * @return mixed
	 */
	public function getSplit()
	{
		return $this->split;
	}

	/**
	 * @param mixed $split
	 */
	public function setSplit($split)
	{
		$this->split = $split;
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
	public function getLoser()
	{
		return $this->loser;
	}

	/**
	 * @param mixed $loser
	 */
	public function setLoser($loser)
	{
		$this->loser = $loser;
	}

	/**
	 * @return mixed
	 */
	public function getBestOf()
	{
		return $this->bestOf;
	}

	/**
	 * @param mixed $bestOf
	 */
	public function setBestOf($bestOf)
	{
		$this->bestOf = $bestOf;
	}

	/**
	 * @return \DateTime
	 */
	public function getDatePlayed()
	{
		return $this->datePlayed;
	}

	/**
	 * @param \DateTime $datePlayed
	 */
	public function setDatePlayed($datePlayed)
	{
		$this->datePlayed = $datePlayed;
	}

	/**
	 * @return boolean
	 */
	public function getTieBreaker()
	{
		return $this->tieBreaker;
	}

	/**
	 * @param boolean $tieBreaker
	 */
	public function setTieBreaker($tieBreaker)
	{
		$this->tieBreaker = $tieBreaker;
	}

	/**
	 * @return integer
	 */
	public function getTournament()
	{
		return $this->tournament;
	}

	/**
	 * @param integer $tournament
	 */
	public function setTournament($tournament)
	{
		$this->tournament = $tournament;
	}

	/**
	 * @return string
	 */
	public function getTournamentRound()
	{
		return $this->tournamentRound;
	}

	/**
	 * @param string $tournamentRound
	 */
	public function setTournamentRound($tournamentRound)
	{
		$this->tournamentRound = $tournamentRound;
	}
}
