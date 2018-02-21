<?php

namespace App\Util\Esports\Sync;

use App\Entity\Champions;
use App\Entity\Games;
use App\Entity\Matches;
use App\Entity\PlayerGameStats;
use App\Entity\TeamGameStats;
use App\Entity\Teams;
use App\Enum\ChampionIdEnum;
use App\Integration\ModelInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;

//----------------------------------------------
//     1 | Team Solo Mid        | TSM      | NA
//     2 | Team Liquid          | TL       | NA
//     4 | FlyQuest             | FlyQuest | NA
//     5 | Counter Logic Gaming | CLG      | NA
//     8 | Cloud 9              | C9       | NA
//     9 | Echo Fox             | Echo Fox | NA
//     3 | Golden Guardians     | GGS      | NA
//     6 | Clutch Gaming        | CG       | NA
//     7 | 100 Thieves          | 100T     | NA
//    10 | Optic Gaming         | OPT      | NA
//----------------------------------------------

/**
 * Class WeeklyStats for getting weekly esports stats persisted to postgres.
 */
class WeeklyStats
{
	/**
	 * @var ModelInterface
	 */
	protected $model;

	/**
	 * @var EntityManager
	 */
	protected $em;

	/**
	 * @var ObjectRepository
	 */
	protected $repository;

	/**
	 * WeeklyStats constructor.
	 *
	 * @param ModelInterface   $model
	 * @param EntityManager    $em
	 * @param ObjectRepository $repository
	 */
	public function __construct(ModelInterface $model, EntityManager $em, ObjectRepository $repository)
	{
		$this->model      = $model;
		$this->em         = $em;
		$this->repository = $repository;
	}

	/**
	 * @param string    $resource
	 * @param integer   $blueTeam
	 * @param integer   $redTeam
	 * @param \DateTime $date
	 *
	 * @return void
	 */
	public function getWeeklyStats($resource, $blueTeam, $redTeam, \DateTime $date)
	{
		$expr     = new ExpressionBuilder();
		$criteria = new Criteria($expr->eq('resource', $resource));

		/** @var \App\Entity\EsportsMatch $results */
		$results = $this->model->read($criteria)->current();

		$teams = $results->getTeams();

		$teams[0]->teamId = $blueTeam; //BLUE TEAM
		$teams[1]->teamId = $redTeam; //RED TEAM

		$winner = $teams[0]->win == 'Win' ? $teams[0] : $teams[1];
		$loser  = $teams[0]->win != 'Win' ? $teams[0] : $teams[1];

		$match = new Matches();
		$match->setSeason(1);
		$match->setWeek(1);
		$match->setBestOf(1);
		$match->setDatePlayed($date);
		$match->setWinner($this->em->find(Teams::class, $winner->teamId));
		$match->setLoser($this->em->find(Teams::class, $loser->teamId));

		$this->em->persist($match);
		$this->em->flush();

		$game = new Games();
		$game->setRedTeam($this->em->find(Teams::class, $teams[1]->teamId));
		$game->setBlueTeam($this->em->find(Teams::class, $teams[0]->teamId));
		$game->setDuration($results->getGameDuration());
		$game->setWinner($match->getWinner());
		$game->setMatch($match);

		$this->em->persist($game);
		$this->em->flush();

		$teamGameStat = new TeamGameStats();
		$teamGameStat->setTeam($game->getBlueTeam());
		$teamGameStat->setGame($game);
		$teamGameStat->setFirstBlood($teams[0]->firstBlood);
		$teamGameStat->setFirstTower($teams[0]->firstTower);
		$teamGameStat->setFirstInhibitor($teams[0]->firstInhibitor);
		$teamGameStat->setFirstDrake($teams[0]->firstDragon);
		$teamGameStat->setFirstBaron($teams[0]->firstBaron);
		$teamGameStat->setRiftHerald($teams[0]->firstRiftHerald);
		$teamGameStat->setFirstElderDrake(false);
		$teamGameStat->setTotalTowers($teams[0]->towerKills);
		$teamGameStat->setTotalDrakes($teams[0]->dragonKills);
		$teamGameStat->setTotalInhibitors($teams[0]->inhibitorKills);
		$teamGameStat->setTotalBarons($teams[0]->baronKills);

		$teamGameStat1 = new TeamGameStats();
		$teamGameStat1->setTeam($game->getRedTeam());
		$teamGameStat1->setGame($game);
		$teamGameStat1->setFirstBlood($teams[1]->firstBlood);
		$teamGameStat1->setFirstTower($teams[1]->firstTower);
		$teamGameStat1->setFirstInhibitor($teams[1]->firstInhibitor);
		$teamGameStat1->setFirstDrake($teams[1]->firstDragon);
		$teamGameStat1->setFirstBaron($teams[1]->firstBaron);
		$teamGameStat1->setRiftHerald($teams[1]->firstRiftHerald);
		$teamGameStat1->setFirstElderDrake(false);
		$teamGameStat1->setTotalTowers($teams[1]->towerKills);
		$teamGameStat1->setTotalDrakes($teams[1]->dragonKills);
		$teamGameStat1->setTotalInhibitors($teams[1]->inhibitorKills);
		$teamGameStat1->setTotalBarons($teams[1]->baronKills);

		$this->em->persist($teamGameStat);
		$this->em->persist($teamGameStat1);

		$this->em->flush();

		$participantIds = $results->getParticipantIdentities();
		$participants   = $results->getParticipants();
		$champRepo      = $this->em->getRepository(Champions::class);

		foreach ($participants as $participant) {
			$player = null;
			foreach ($participantIds as $pid) {
				if ($pid->participantId == $participant->participantId) {
					$sumName = explode(' ', $pid->player->summonerName)[1];
					$player  = $this->repository->findOneByName($sumName);
					break;
				}
			}
			$champion = $champRepo->findOneByLabel(strtolower(ChampionIdEnum::getChampionName($participant->championId)));

			$playerGameStat = new PlayerGameStats();
			$playerGameStat->setPlayer($player);
			$playerGameStat->setChampion($champion);
			$playerGameStat->setGame($game);
			$playerGameStat->setKills($participant->stats->kills);
			$playerGameStat->setAssists($participant->stats->assists);
			$playerGameStat->setDeaths($participant->stats->deaths);
			$playerGameStat->setGold($participant->stats->goldEarned);
			$playerGameStat->setCreepScore($participant->stats->totalMinionsKilled + $participant->stats->neutralMinionsKilled);
			$playerGameStat->setFirstBlood($participant->stats->firstBloodKill);
			$playerGameStat->setFirstBloodAssist($participant->stats->firstBloodAssist);
			$playerGameStat->setFirstDeath(false);
			$playerGameStat->setDamageDealtToChampions($participant->stats->totalDamageDealtToChampions);
			$playerGameStat->setVisionScore($participant->stats->visionScore);
			$playerGameStat->setWardsPlaced($participant->stats->wardsPlaced);
			$playerGameStat->setWardsDestroyed($participant->stats->wardsKilled);
			$playerGameStat->setLargestKillingSpree($participant->stats->largestKillingSpree);
			$playerGameStat->setLargestMultiKill($participant->stats->largestMultiKill);
			$playerGameStat->setKillingSprees($participant->stats->killingSprees);
			$playerGameStat->setLongestTimeSpentLiving($participant->stats->longestTimeSpentLiving);
			$playerGameStat->setDoubleKills($participant->stats->doubleKills);
			$playerGameStat->setTripleKills($participant->stats->tripleKills);
			$playerGameStat->setQuadraKills($participant->stats->quadraKills);
			$playerGameStat->setPentaKills($participant->stats->pentaKills);
			$playerGameStat->setUnrealKills($participant->stats->unrealKills);
			$playerGameStat->setTotalDamageDealt($participant->stats->totalDamageDealt);
			$playerGameStat->setMagicDamageDealt($participant->stats->magicDamageDealt);
			$playerGameStat->setPhysicalDamageDealt($participant->stats->physicalDamageDealt);
			$playerGameStat->setTrueDamageDealt($participant->stats->trueDamageDealt);
			$playerGameStat->setLargestCriticalStrike($participant->stats->largestCriticalStrike);
			$playerGameStat->setMagicDamageDealtToChampions($participant->stats->magicDamageDealtToChampions);
			$playerGameStat->setPhysicalDamageDealtToChampions($participant->stats->physicalDamageDealtToChampions);
			$playerGameStat->setTrueDamageDealtToChampions($participant->stats->trueDamageDealtToChampions);
			$playerGameStat->setTotalHeal($participant->stats->totalHeal);
			$playerGameStat->setTotalUnitsHealed($participant->stats->totalUnitsHealed);
			$playerGameStat->setDamageSelfMitigated($participant->stats->damageSelfMitigated);
			$playerGameStat->setDamageDealtToObjectives($participant->stats->damageDealtToObjectives);
			$playerGameStat->setDamageDealtToTurrets($participant->stats->damageDealtToTurrets);
			$playerGameStat->setTimeCCingOthers($participant->stats->timeCCingOthers);
			$playerGameStat->setTotalDamageTaken($participant->stats->totalDamageTaken);
			$playerGameStat->setMagicalDamageTaken($participant->stats->magicalDamageTaken);
			$playerGameStat->setPhysicalDamageTaken($participant->stats->physicalDamageTaken);
			$playerGameStat->setTrueDamageTaken($participant->stats->trueDamageTaken);
			$playerGameStat->setGoldSpent($participant->stats->goldSpent);
			$playerGameStat->setTurretKills($participant->stats->turretKills);
			$playerGameStat->setInhibitorKills($participant->stats->inhibitorKills);
			$playerGameStat->setTotalMinionsKilled($participant->stats->totalMinionsKilled);
			$playerGameStat->setNeutralMinionsKilled($participant->stats->neutralMinionsKilled);
			$playerGameStat->setNeutralMinionsKilledTeamJungle($participant->stats->neutralMinionsKilledTeamJungle);
			$playerGameStat->setNeutralMinionsKilledEnemyJungle($participant->stats->neutralMinionsKilledEnemyJungle);
			$playerGameStat->setTotalTimeCrowdControlDealt($participant->stats->totalTimeCrowdControlDealt);
			$playerGameStat->setChampLevel($participant->stats->champLevel);
			$playerGameStat->setVisionWardsBoughtInGame($participant->stats->visionWardsBoughtInGame);
			$playerGameStat->setSightWardsBoughtInGame($participant->stats->sightWardsBoughtInGame);
			$playerGameStat->setFirstInhibitorKill($participant->stats->firstInhibitorKill);
			$playerGameStat->setFirstInhibitorAssist($participant->stats->firstInhibitorAssist);
			$playerGameStat->setFirstTowerKill($participant->stats->firstTowerKill);
			$playerGameStat->setFirstTowerAssist($participant->stats->firstTowerAssist);

			$this->em->persist($playerGameStat);
			$this->em->flush();
		}
	}
}
