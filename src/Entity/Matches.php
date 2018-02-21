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
	 * @ORM\ManyToOne(targetEntity="\App\Entity\Teams", fetch="EXTRA_LAZY")
	 * @ORM\JoinColumn(name="winner", referencedColumnName="team_id")
	 */
	private $winner;

	/**
	 * Loser.
	 *
	 * @Groups({"public"})
	 * @ORM\ManyToOne(targetEntity="\App\Entity\Teams", fetch="EXTRA_LAZY")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="loser", referencedColumnName="team_id")
	 * })
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
}
