<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="game_events")
 */
class GameEvents
{
    /**
     * Player Game Stats primary key.
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $gameEventId;

    /**
     * Game.
     *
     * @Groups({"public"})
     * @ORM\OneToOne(targetEntity="Games")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="game_id")
     */
    private $game;

    /**
     * Player.
     *
     * @Groups({"public"})
     * @ORM\OneToOne(targetEntity="Players")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="player_id")
     */
    private $player;

    /**
     * event type
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * timestamp
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $timestamp;

    /**
     * ward type
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $wardType;

    /**
     * item id.
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $itemId;

    /**
     * x axis position.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $positionX;

    /**
     * y axis position.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $positionY;

    /**
     * Victim.
     *
     * @Groups({"public"})
     * @ORM\OneToOne(targetEntity="Players")
     * @ORM\JoinColumn(name="victim_id", referencedColumnName="player_id")
     */
    private $victim;

    /**
     * bans.
     *
     * @Groups({"public"})
     * @ORM\Column(type="array_champions", nullable=true)
     */
    private $participantIds = [];

    /**
     * Monster Type
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $monsterType;

    /**
     * Monster sub type.
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $monsterSubType;

    /**
     * Building type.
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $buildingType;

    /**
     * Lane type.
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $laneType;

    /**
     * Tower type.
     *
     * @Groups({"public"})
     * @ORM\Column(type="string")
     */
    private $towerType;

    /**
     * Team.
     *
     * @Groups({"public"})
     * @ORM\ManyToOne(targetEntity="Teams", inversedBy="players")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="team_id")
     */
    private $team;

    /**
     * @return mixed
     */
    public function getGameEventId()
    {
        return $this->gameEventId;
    }

    /**
     * @param mixed $gameEventId
     */
    public function setGameEventId($gameEventId)
    {
        $this->gameEventId = $gameEventId;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getWardType()
    {
        return $this->wardType;
    }

    /**
     * @param mixed $wardType
     */
    public function setWardType($wardType)
    {
        $this->wardType = $wardType;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return mixed
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * @param mixed $positionX
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;
    }

    /**
     * @return mixed
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * @param mixed $positionY
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;
    }

    /**
     * @return mixed
     */
    public function getVictim()
    {
        return $this->victim;
    }

    /**
     * @param mixed $victim
     */
    public function setVictim($victim)
    {
        $this->victim = $victim;
    }

    /**
     * @return mixed
     */
    public function getParticipantIds()
    {
        return $this->participantIds;
    }

    /**
     * @param mixed $participantIds
     */
    public function setParticipantIds($participantIds)
    {
        $this->participantIds = $participantIds;
    }

    /**
     * @return mixed
     */
    public function getMonsterType()
    {
        return $this->monsterType;
    }

    /**
     * @param mixed $monsterType
     */
    public function setMonsterType($monsterType)
    {
        $this->monsterType = $monsterType;
    }

    /**
     * @return mixed
     */
    public function getMonsterSubType()
    {
        return $this->monsterSubType;
    }

    /**
     * @param mixed $monsterSubType
     */
    public function setMonsterSubType($monsterSubType)
    {
        $this->monsterSubType = $monsterSubType;
    }

    /**
     * @return mixed
     */
    public function getBuildingType()
    {
        return $this->buildingType;
    }

    /**
     * @param mixed $buildingType
     */
    public function setBuildingType($buildingType)
    {
        $this->buildingType = $buildingType;
    }

    /**
     * @return mixed
     */
    public function getLaneType()
    {
        return $this->laneType;
    }

    /**
     * @param mixed $laneType
     */
    public function setLaneType($laneType)
    {
        $this->laneType = $laneType;
    }

    /**
     * @return mixed
     */
    public function getTowerType()
    {
        return $this->towerType;
    }

    /**
     * @param mixed $towerType
     */
    public function setTowerType($towerType)
    {
        $this->towerType = $towerType;
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
}
