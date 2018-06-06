<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_game_stats")
 */
class PlayerGameStats
{
	/**
	 * Player Game Stats primary key.
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $playerGameStatId;

	/**
	 * Player.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Players")
	 * @ORM\JoinColumn(name="player_id", referencedColumnName="player_id")
	 */
	private $player;

	/**
	 * Champion.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Champions")
	 * @ORM\JoinColumn(name="champion_id", referencedColumnName="champion_id")
	 */
	private $champion;

	/**
	 * Game.
	 *
	 * @Groups({"public"})
	 * @ORM\OneToOne(targetEntity="Games")
	 * @ORM\JoinColumn(name="game_id", referencedColumnName="game_id")
	 */
	private $game;

	/**
	 * Kills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $kills;

	/**
	 * Assists.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $assists;

	/**
	 * Deaths.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $deaths;

	/**
	 * Gold.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $gold;

	/**
	 * Creep Score (CS).
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $creepScore;

	/**
	 * First Blood.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstBlood;

	/**
	 * First Blood.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstBloodAssist;

	/**
	 * First death.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="boolean")
	 */
	private $firstDeath;

	/**
	 * Creep Score (CS).
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $damageDealtToChampions;

	/**
	 * Creep Score (CS).
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $visionScore;

	/**
	 * Creep Score (CS).
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $wardsPlaced;

	/**
	 * Creep Score (CS).
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $wardsDestroyed;

	/**
	 * largestKillingSpree.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $largestKillingSpree;

	/**
	 * largestMultiKill.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $largestMultiKill;

	/**
	 * killingSprees.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $killingSprees;

	/**
	 * longestTimeSpentLiving.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $longestTimeSpentLiving;

	/**
	 * doubleKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $doubleKills;

	/**
	 * tripleKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $tripleKills;

	/**
	 * quadraKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $quadraKills;

	/**
	 * pentaKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $pentaKills;

	/**
	 * unrealKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $unrealKills;

	/**
	 * totalDamageDealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalDamageDealt;

	/**
	 * magicDamageDealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $magicDamageDealt;

	/**
	 * physicalDamageDealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $physicalDamageDealt;

	/**
	 * trueDamageDealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $trueDamageDealt;

	/**
	 * largestCriticalStrike.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $largestCriticalStrike;

	/**
	 * magicDamageDealtToChampions.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $magicDamageDealtToChampions;

	/**
	 * physicalDamageDealtToChampions.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $physicalDamageDealtToChampions;

	/**
	 * trueDamageDealtToChampions.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $trueDamageDealtToChampions;

	/**
	 * totalHeal.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalHeal;

	/**
	 * totalUnitsHealed.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalUnitsHealed;

	/**
	 * damageSelfMitigated.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $damageSelfMitigated;

	/**
	 * damageDealtToObjectives.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $damageDealtToObjectives;

	/**
	 * damageDealtToTurrets.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $damageDealtToTurrets;

	/**
	 * timeCCingOthers.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $timeCCingOthers;

	/**
	 * totalDamageTaken.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalDamageTaken;

	/**
	 * magicalDamageTaken.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $magicalDamageTaken;

	/**
	 * physicalDamageTaken.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $physicalDamageTaken;

	/**
	 * trueDamageTaken.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $trueDamageTaken;

	/**
	 * goldSpent.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $goldSpent;

	/**
	 * turretKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $turretKills;

	/**
	 * inhibitorKills.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $inhibitorKills;

	/**
	 * totalMinionsKilled.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalMinionsKilled;

	/**
	 * neutralMinionsKilled.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $neutralMinionsKilled;

	/**
	 * neutralMinionsKilledTeamJungle.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $neutralMinionsKilledTeamJungle;

	/**
	 * neutralMinionsKilledEnemyJungle.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $neutralMinionsKilledEnemyJungle;

	/**
	 * totalTimeCrowdControlDealt.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $totalTimeCrowdControlDealt;

	/**
	 * champLevel.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $champLevel;

	/**
	 * visionWardsBoughtInGame.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $visionWardsBoughtInGame;

	/**
	 * sightWardsBoughtInGame.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $sightWardsBoughtInGame;

	/**
	 * firstTowerKill.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $firstTowerKill;

	/**
	 * firstTowerAssist.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $firstTowerAssist;

	/**
	 * firstInhibitorKill.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $firstInhibitorKill;

	/**
	 * firstInhibitorAssist.
	 *
	 * @Groups({"public"})
	 * @ORM\Column(type="integer")
	 */
	private $firstInhibitorAssist;

	/**
	 * @return mixed
	 */
	public function getPlayerGameStatId()
	{
		return $this->playerGameStatId;
	}

	/**
	 * @return mixed
	 */
	public function getPlayer()
	{
		return $this->player;
	}

	/**
	 * @return mixed
	 */
	public function getGame()
	{
		return $this->game;
	}

	/**
	 * @return mixed
	 */
	public function getKills()
	{
		return $this->kills;
	}

	/**
	 * @return mixed
	 */
	public function getAssists()
	{
		return $this->assists;
	}

	/**
	 * @return mixed
	 */
	public function getDeaths()
	{
		return $this->deaths;
	}

	/**
	 * @return mixed
	 */
	public function getGold()
	{
		return $this->gold;
	}

	/**
	 * @return mixed
	 */
	public function getCreepScore()
	{
		return $this->creepScore;
	}

	/**
	 * @return mixed
	 */
	public function getFirstBlood()
	{
		return $this->firstBlood;
	}

	/**
	 * @return mixed
	 */
	public function getFirstDeath()
	{
		return $this->firstDeath;
	}

	/**
	 * @return int
	 */
	public function getDamageDealtToChampions()
	{
		return $this->damageDealtToChampions;
	}

	/**
	 * @return int
	 */
	public function getVisionScore()
	{
		return $this->visionScore;
	}

	/**
	 * @return int
	 */
	public function getWardsPlaced()
	{
		return $this->wardsPlaced;
	}

	/**
	 * @return int
	 */
	public function getWardsDestroyed()
	{
		return $this->wardsDestroyed;
	}

	/**
	 * @param Players $player
	 */
	public function setPlayer($player)
	{
		$this->player = $player;
	}

	/**
	 * @return Champions
	 */
	public function getChampion()
	{
		return $this->champion;
	}

	/**
	 * @param Champions $champion
	 */
	public function setChampion($champion)
	{
		$this->champion = $champion;
	}

	/**
	 * @param Games $game
	 */
	public function setGame($game)
	{
		$this->game = $game;
	}

	/**
	 * @param int $kills
	 */
	public function setKills($kills)
	{
		$this->kills = $kills;
	}

	/**
	 * @param int $assists
	 */
	public function setAssists($assists)
	{
		$this->assists = $assists;
	}

	/**
	 * @param int $deaths
	 */
	public function setDeaths($deaths)
	{
		$this->deaths = $deaths;
	}

	/**
	 * @param int $gold
	 */
	public function setGold($gold)
	{
		$this->gold = $gold;
	}

	/**
	 * @param int $creepScore
	 */
	public function setCreepScore($creepScore)
	{
		$this->creepScore = $creepScore;
	}

	/**
	 * @param bool $firstBlood
	 */
	public function setFirstBlood($firstBlood)
	{
		$this->firstBlood = $firstBlood;
	}

	/**
	 * @param bool $firstDeath
	 */
	public function setFirstDeath($firstDeath)
	{
		$this->firstDeath = $firstDeath;
	}

	/**
	 * @param int $damageDealtToChampions
	 */
	public function setDamageDealtToChampions($damageDealtToChampions)
	{
		$this->damageDealtToChampions = $damageDealtToChampions;
	}

	/**
	 * @param int $visionScore
	 */
	public function setVisionScore($visionScore)
	{
		$this->visionScore = $visionScore;
	}

	/**
	 * @param int $wardsPlaced
	 */
	public function setWardsPlaced($wardsPlaced)
	{
		$this->wardsPlaced = $wardsPlaced;
	}

	/**
	 * @param int $wardsDestroyed
	 */
	public function setWardsDestroyed($wardsDestroyed)
	{
		$this->wardsDestroyed = $wardsDestroyed;
	}

	/**
	 * @return bool
	 */
	public function isFirstBloodAssist()
	{
		return $this->firstBloodAssist;
	}

	/**
	 * @param bool $firstBloodAssist
	 */
	public function setFirstBloodAssist($firstBloodAssist)
	{
		$this->firstBloodAssist = $firstBloodAssist;
	}

	/**
	 * @return int
	 */
	public function getLargestKillingSpree()
	{
		return $this->largestKillingSpree;
	}

	/**
	 * @param int $largestKillingSpree
	 */
	public function setLargestKillingSpree($largestKillingSpree)
	{
		$this->largestKillingSpree = $largestKillingSpree;
	}

	/**
	 * @return int
	 */
	public function getLargestMultiKill()
	{
		return $this->largestMultiKill;
	}

	/**
	 * @param int $largestMultiKill
	 */
	public function setLargestMultiKill($largestMultiKill)
	{
		$this->largestMultiKill = $largestMultiKill;
	}

	/**
	 * @return int
	 */
	public function getKillingSprees()
	{
		return $this->killingSprees;
	}

	/**
	 * @param int $killingSprees
	 */
	public function setKillingSprees($killingSprees)
	{
		$this->killingSprees = $killingSprees;
	}

	/**
	 * @return int
	 */
	public function getLongestTimeSpentLiving()
	{
		return $this->longestTimeSpentLiving;
	}

	/**
	 * @param int $longestTimeSpentLiving
	 */
	public function setLongestTimeSpentLiving($longestTimeSpentLiving)
	{
		$this->longestTimeSpentLiving = $longestTimeSpentLiving;
	}

	/**
	 * @return int
	 */
	public function getDoubleKills()
	{
		return $this->doubleKills;
	}

	/**
	 * @param int $doubleKills
	 */
	public function setDoubleKills($doubleKills)
	{
		$this->doubleKills = $doubleKills;
	}

	/**
	 * @return int
	 */
	public function getTripleKills()
	{
		return $this->tripleKills;
	}

	/**
	 * @param int $tripleKills
	 */
	public function setTripleKills($tripleKills)
	{
		$this->tripleKills = $tripleKills;
	}

	/**
	 * @return int
	 */
	public function getQuadraKills()
	{
		return $this->quadraKills;
	}

	/**
	 * @param int $quadraKills
	 */
	public function setQuadraKills($quadraKills)
	{
		$this->quadraKills = $quadraKills;
	}

	/**
	 * @return int
	 */
	public function getPentaKills()
	{
		return $this->pentaKills;
	}

	/**
	 * @param int $pentaKills
	 */
	public function setPentaKills($pentaKills)
	{
		$this->pentaKills = $pentaKills;
	}

	/**
	 * @return int
	 */
	public function getUnrealKills()
	{
		return $this->unrealKills;
	}

	/**
	 * @param int $unrealKills
	 */
	public function setUnrealKills($unrealKills)
	{
		$this->unrealKills = $unrealKills;
	}

	/**
	 * @return int
	 */
	public function getTotalDamageDealt()
	{
		return $this->totalDamageDealt;
	}

	/**
	 * @param int $totalDamageDealt
	 */
	public function setTotalDamageDealt($totalDamageDealt)
	{
		$this->totalDamageDealt = $totalDamageDealt;
	}

	/**
	 * @return int
	 */
	public function getMagicDamageDealt()
	{
		return $this->magicDamageDealt;
	}

	/**
	 * @param int $magicDamageDealt
	 */
	public function setMagicDamageDealt($magicDamageDealt)
	{
		$this->magicDamageDealt = $magicDamageDealt;
	}

	/**
	 * @return int
	 */
	public function getPhysicalDamageDealt()
	{
		return $this->physicalDamageDealt;
	}

	/**
	 * @param int $physicalDamageDealt
	 */
	public function setPhysicalDamageDealt($physicalDamageDealt)
	{
		$this->physicalDamageDealt = $physicalDamageDealt;
	}

	/**
	 * @return int
	 */
	public function getTrueDamageDealt()
	{
		return $this->trueDamageDealt;
	}

	/**
	 * @param int $trueDamageDealt
	 */
	public function setTrueDamageDealt($trueDamageDealt)
	{
		$this->trueDamageDealt = $trueDamageDealt;
	}

	/**
	 * @return int
	 */
	public function getLargestCriticalStrike()
	{
		return $this->largestCriticalStrike;
	}

	/**
	 * @param int $largestCriticalStrike
	 */
	public function setLargestCriticalStrike($largestCriticalStrike)
	{
		$this->largestCriticalStrike = $largestCriticalStrike;
	}

	/**
	 * @return int
	 */
	public function getMagicDamageDealtToChampions()
	{
		return $this->magicDamageDealtToChampions;
	}

	/**
	 * @param int $magicDamageDealtToChampions
	 */
	public function setMagicDamageDealtToChampions($magicDamageDealtToChampions)
	{
		$this->magicDamageDealtToChampions = $magicDamageDealtToChampions;
	}

	/**
	 * @return int
	 */
	public function getPhysicalDamageDealtToChampions()
	{
		return $this->physicalDamageDealtToChampions;
	}

	/**
	 * @param int $physicalDamageDealtToChampions
	 */
	public function setPhysicalDamageDealtToChampions($physicalDamageDealtToChampions)
	{
		$this->physicalDamageDealtToChampions = $physicalDamageDealtToChampions;
	}

	/**
	 * @return int
	 */
	public function getTrueDamageDealtToChampions()
	{
		return $this->trueDamageDealtToChampions;
	}

	/**
	 * @param int $trueDamageDealtToChampions
	 */
	public function setTrueDamageDealtToChampions($trueDamageDealtToChampions)
	{
		$this->trueDamageDealtToChampions = $trueDamageDealtToChampions;
	}

	/**
	 * @return int
	 */
	public function getTotalHeal()
	{
		return $this->totalHeal;
	}

	/**
	 * @param int $totalHeal
	 */
	public function setTotalHeal($totalHeal)
	{
		$this->totalHeal = $totalHeal;
	}

	/**
	 * @return int
	 */
	public function getTotalUnitsHealed()
	{
		return $this->totalUnitsHealed;
	}

	/**
	 * @param int $totalUnitsHealed
	 */
	public function setTotalUnitsHealed($totalUnitsHealed)
	{
		$this->totalUnitsHealed = $totalUnitsHealed;
	}

	/**
	 * @return int
	 */
	public function getDamageSelfMitigated()
	{
		return $this->damageSelfMitigated;
	}

	/**
	 * @param int $damageSelfMitigated
	 */
	public function setDamageSelfMitigated($damageSelfMitigated)
	{
		$this->damageSelfMitigated = $damageSelfMitigated;
	}

	/**
	 * @return int
	 */
	public function getDamageDealtToObjectives()
	{
		return $this->damageDealtToObjectives;
	}

	/**
	 * @param int $damageDealtToObjectives
	 */
	public function setDamageDealtToObjectives($damageDealtToObjectives)
	{
		$this->damageDealtToObjectives = $damageDealtToObjectives;
	}

	/**
	 * @return int
	 */
	public function getDamageDealtToTurrets()
	{
		return $this->damageDealtToTurrets;
	}

	/**
	 * @param int $damageDealtToTurrets
	 */
	public function setDamageDealtToTurrets($damageDealtToTurrets)
	{
		$this->damageDealtToTurrets = $damageDealtToTurrets;
	}

	/**
	 * @return int
	 */
	public function getTimeCCingOthers()
	{
		return $this->timeCCingOthers;
	}

	/**
	 * @param int $timeCCingOthers
	 */
	public function setTimeCCingOthers($timeCCingOthers)
	{
		$this->timeCCingOthers = $timeCCingOthers;
	}

	/**
	 * @return int
	 */
	public function getTotalDamageTaken()
	{
		return $this->totalDamageTaken;
	}

	/**
	 * @param int $totalDamageTaken
	 */
	public function setTotalDamageTaken($totalDamageTaken)
	{
		$this->totalDamageTaken = $totalDamageTaken;
	}

	/**
	 * @return int
	 */
	public function getMagicalDamageTaken()
	{
		return $this->magicalDamageTaken;
	}

	/**
	 * @param int $magicalDamageTaken
	 */
	public function setMagicalDamageTaken($magicalDamageTaken)
	{
		$this->magicalDamageTaken = $magicalDamageTaken;
	}

	/**
	 * @return int
	 */
	public function getPhysicalDamageTaken()
	{
		return $this->physicalDamageTaken;
	}

	/**
	 * @param int $physicalDamageTaken
	 */
	public function setPhysicalDamageTaken($physicalDamageTaken)
	{
		$this->physicalDamageTaken = $physicalDamageTaken;
	}

	/**
	 * @return int
	 */
	public function getTrueDamageTaken()
	{
		return $this->trueDamageTaken;
	}

	/**
	 * @param int $trueDamageTaken
	 */
	public function setTrueDamageTaken($trueDamageTaken)
	{
		$this->trueDamageTaken = $trueDamageTaken;
	}

	/**
	 * @return int
	 */
	public function getGoldSpent()
	{
		return $this->goldSpent;
	}

	/**
	 * @param int $goldSpent
	 */
	public function setGoldSpent($goldSpent)
	{
		$this->goldSpent = $goldSpent;
	}

	/**
	 * @return int
	 */
	public function getTurretKills()
	{
		return $this->turretKills;
	}

	/**
	 * @param int $turretKills
	 */
	public function setTurretKills($turretKills)
	{
		$this->turretKills = $turretKills;
	}

	/**
	 * @return int
	 */
	public function getInhibitorKills()
	{
		return $this->inhibitorKills;
	}

	/**
	 * @param int $inhibitorKills
	 */
	public function setInhibitorKills($inhibitorKills)
	{
		$this->inhibitorKills = $inhibitorKills;
	}

	/**
	 * @return int
	 */
	public function getTotalMinionsKilled()
	{
		return $this->totalMinionsKilled;
	}

	/**
	 * @param int $totalMinionsKilled
	 */
	public function setTotalMinionsKilled($totalMinionsKilled)
	{
		$this->totalMinionsKilled = $totalMinionsKilled;
	}

	/**
	 * @return int
	 */
	public function getNeutralMinionsKilled()
	{
		return $this->neutralMinionsKilled;
	}

	/**
	 * @param int $neutralMinionsKilled
	 */
	public function setNeutralMinionsKilled($neutralMinionsKilled)
	{
		$this->neutralMinionsKilled = $neutralMinionsKilled;
	}

	/**
	 * @return int
	 */
	public function getNeutralMinionsKilledTeamJungle()
	{
		return $this->neutralMinionsKilledTeamJungle;
	}

	/**
	 * @param int $neutralMinionsKilledTeamJungle
	 */
	public function setNeutralMinionsKilledTeamJungle($neutralMinionsKilledTeamJungle)
	{
		$this->neutralMinionsKilledTeamJungle = $neutralMinionsKilledTeamJungle;
	}

	/**
	 * @return int
	 */
	public function getNeutralMinionsKilledEnemyJungle()
	{
		return $this->neutralMinionsKilledEnemyJungle;
	}

	/**
	 * @param int $neutralMinionsKilledEnemyJungle
	 */
	public function setNeutralMinionsKilledEnemyJungle($neutralMinionsKilledEnemyJungle)
	{
		$this->neutralMinionsKilledEnemyJungle = $neutralMinionsKilledEnemyJungle;
	}

	/**
	 * @return int
	 */
	public function getTotalTimeCrowdControlDealt()
	{
		return $this->totalTimeCrowdControlDealt;
	}

	/**
	 * @param int $totalTimeCrowdControlDealt
	 */
	public function setTotalTimeCrowdControlDealt($totalTimeCrowdControlDealt)
	{
		$this->totalTimeCrowdControlDealt = $totalTimeCrowdControlDealt;
	}

	/**
	 * @return int
	 */
	public function getChampLevel()
	{
		return $this->champLevel;
	}

	/**
	 * @param int $champLevel
	 */
	public function setChampLevel($champLevel)
	{
		$this->champLevel = $champLevel;
	}

	/**
	 * @return int
	 */
	public function getVisionWardsBoughtInGame()
	{
		return $this->visionWardsBoughtInGame;
	}

	/**
	 * @param int $visionWardsBoughtInGame
	 */
	public function setVisionWardsBoughtInGame($visionWardsBoughtInGame)
	{
		$this->visionWardsBoughtInGame = $visionWardsBoughtInGame;
	}

	/**
	 * @return int
	 */
	public function getSightWardsBoughtInGame()
	{
		return $this->sightWardsBoughtInGame;
	}

	/**
	 * @param int $sightWardsBoughtInGame
	 */
	public function setSightWardsBoughtInGame($sightWardsBoughtInGame)
	{
		$this->sightWardsBoughtInGame = $sightWardsBoughtInGame;
	}

	/**
	 * @return int
	 */
	public function getFirstTowerKill()
	{
		return $this->firstTowerKill;
	}

	/**
	 * @param int $firstTowerKill
	 */
	public function setFirstTowerKill($firstTowerKill)
	{
		$this->firstTowerKill = $firstTowerKill;
	}

	/**
	 * @return int
	 */
	public function getFirstTowerAssist()
	{
		return $this->firstTowerAssist;
	}

	/**
	 * @param int $firstTowerAssist
	 */
	public function setFirstTowerAssist($firstTowerAssist)
	{
		$this->firstTowerAssist = $firstTowerAssist;
	}

	/**
	 * @return int
	 */
	public function getFirstInhibitorKill()
	{
		return $this->firstInhibitorKill;
	}

	/**
	 * @param int $firstInhibitorKill
	 */
	public function setFirstInhibitorKill($firstInhibitorKill)
	{
		$this->firstInhibitorKill = $firstInhibitorKill;
	}

	/**
	 * @return int
	 */
	public function getFirstInhibitorAssist()
	{
		return $this->firstInhibitorAssist;
	}

	/**
	 * @param int $firstInhibitorAssist
	 */
	public function setFirstInhibitorAssist($firstInhibitorAssist)
	{
		$this->firstInhibitorAssist = $firstInhibitorAssist;
	}
}
