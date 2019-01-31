<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PlayerGameStats at 10 minutes.
 * @ORM\Entity
 * @ORM\Table(name="player_game_stats_10")
 */
class PlayerGameStats10
{
    /**
     * Player Game Stats primary key.
     *
     * @ORM\Column(type="integer", name="player_game_stat_10_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $playerGameStat10Id;

    /**
     * @return mixed
     */
    public function getPlayerGameStat10Id()
    {
        return $this->playerGameStat10Id;
    }

    /**
     * @param mixed $playerGameStat10Id
     */
    public function setPlayerGameStat10Id($playerGameStat10Id)
    {
        $this->playerGameStat10Id = $playerGameStat10Id;
    }
    /**
     * Player.
     *
     * @Groups({"public"})
     * @ORM\OneToOne(targetEntity="Players")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="player_id")
     */
    private $player;

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
     * current gold at time.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $currentGold;

    /**
     * Total Gold for game to date.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $totalGold;

    /**
     * Player level 1-18
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * Player experience.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $experience;

    /**
     * Minions killed in lane.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $minionsKilled;

    /**
     * Minions killed in jungle
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $minionsKilledJungle;

    /**
     * Dom score.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $dominionScore;

    /**
     * Team Score.
     *
     * @Groups({"public"})
     * @ORM\Column(type="integer")
     */
    private $teamScore;

    /**
     * Game.
     *
     * @Groups({"public"})
     * @ORM\OneToOne(targetEntity="Games")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="game_id")
     */
    private $game;

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
    public function getCurrentGold()
    {
        return $this->currentGold;
    }

    /**
     * @param mixed $currentGold
     */
    public function setCurrentGold($currentGold)
    {
        $this->currentGold = $currentGold;
    }

    /**
     * @return mixed
     */
    public function getTotalGold()
    {
        return $this->totalGold;
    }

    /**
     * @param mixed $totalGold
     */
    public function setTotalGold($totalGold)
    {
        $this->totalGold = $totalGold;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getMinionsKilled()
    {
        return $this->minionsKilled;
    }

    /**
     * @param mixed $minionsKilled
     */
    public function setMinionsKilled($minionsKilled)
    {
        $this->minionsKilled = $minionsKilled;
    }

    /**
     * @return mixed
     */
    public function getMinionsKilledJungle()
    {
        return $this->minionsKilledJungle;
    }

    /**
     * @param mixed $minionsKilledJungle
     */
    public function setMinionsKilledJungle($minionsKilledJungle)
    {
        $this->minionsKilledJungle = $minionsKilledJungle;
    }

    /**
     * @return mixed
     */
    public function getDominionScore()
    {
        return $this->dominionScore;
    }

    /**
     * @param mixed $dominionScore
     */
    public function setDominionScore($dominionScore)
    {
        $this->dominionScore = $dominionScore;
    }

    /**
     * @return mixed
     */
    public function getTeamScore()
    {
        return $this->teamScore;
    }

    /**
     * @param mixed $teamScore
     */
    public function setTeamScore($teamScore)
    {
        $this->teamScore = $teamScore;
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
}
