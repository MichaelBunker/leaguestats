<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class EsportsMatches
{
	/**
	 * EsportsMatch primary key.
	 *
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $gameId;

	/**
	 * Platform ID.
	 *
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @ORM\Id
	 */
	private $platformId;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $gameCreation;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $gameDuration;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $queueId;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $mapId;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 */
	private $seasonId;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @ORM\Id
	 */
	private $gameVersion;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @ORM\Id
	 */
	private $gameMode;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @ORM\Id
	 */
	private $gameType;

	/**
	 * @var array
	 * @Groups({"public"})
	 */
	private $teams;

	/**
	 * @var array
	 * @Groups({"public"})
	 */
	private $participants;

	/**
	 * @var array
	 * @Groups({"public"})
	 */
	private $participantIdentities;

	/**
	 * @return int
	 */
	public function getGameId()
	{
		return $this->gameId;
	}

	/**
	 * @param int $gameId
	 */
	public function setGameId($gameId)
	{
		$this->gameId = $gameId;
	}

	/**
	 * @return string
	 */
	public function getPlatformId()
	{
		return $this->platformId;
	}

	/**
	 * @param string $platformId
	 */
	public function setPlatformId($platformId)
	{
		$this->platformId = $platformId;
	}

	/**
	 * @return int
	 */
	public function getGameCreation()
	{
		return $this->gameCreation;
	}

	/**
	 * @param int $gameCreation
	 */
	public function setGameCreation($gameCreation)
	{
		$this->gameCreation = $gameCreation;
	}

	/**
	 * @return int
	 */
	public function getGameDuration()
	{
		return $this->gameDuration;
	}

	/**
	 * @param int $gameDuration
	 */
	public function setGameDuration($gameDuration)
	{
		$this->gameDuration = $gameDuration;
	}

	/**
	 * @return int
	 */
	public function getQueueId()
	{
		return $this->queueId;
	}

	/**
	 * @param int $queueId
	 */
	public function setQueueId($queueId)
	{
		$this->queueId = $queueId;
	}

	/**
	 * @return int
	 */
	public function getMapId()
	{
		return $this->mapId;
	}

	/**
	 * @param int $mapId
	 */
	public function setMapId($mapId)
	{
		$this->mapId = $mapId;
	}

	/**
	 * @return int
	 */
	public function getSeasonId()
	{
		return $this->seasonId;
	}

	/**
	 * @param int $seasonId
	 */
	public function setSeasonId($seasonId)
	{
		$this->seasonId = $seasonId;
	}

	/**
	 * @return string
	 */
	public function getGameVersion()
	{
		return $this->gameVersion;
	}

	/**
	 * @param string $gameVersion
	 */
	public function setGameVersion($gameVersion)
	{
		$this->gameVersion = $gameVersion;
	}

	/**
	 * @return string
	 */
	public function getGameMode()
	{
		return $this->gameMode;
	}

	/**
	 * @param string $gameMode
	 */
	public function setGameMode($gameMode)
	{
		$this->gameMode = $gameMode;
	}

	/**
	 * @return string
	 */
	public function getGameType()
	{
		return $this->gameType;
	}

	/**
	 * @param string $gameType
	 */
	public function setGameType($gameType)
	{
		$this->gameType = $gameType;
	}

	/**
	 * @return array
	 */
	public function getTeams()
	{
		return $this->teams;
	}

	/**
	 * @param array $teams
	 */
	public function setTeams($teams)
	{
		$this->teams = $teams;
	}

	/**
	 * @return array
	 */
	public function getParticipants()
	{
		return $this->participants;
	}

	/**
	 * @param array $participants
	 */
	public function setParticipants($participants)
	{
		$this->participants = $participants;
	}

	/**
	 * @return array
	 */
	public function getParticipantIdentities()
	{
		return $this->participantIdentities;
	}

	/**
	 * @param array $participantIdentities
	 */
	public function setParticipantIdentities($participantIdentities)
	{
		$this->participantIdentities = $participantIdentities;
	}
}
