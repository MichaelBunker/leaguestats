<?php

namespace App\DataFixtures;

use App\Entity\Teams;
use App\Entity\Players;
use App\Entity\Matches;
use App\Entity\Games;
use App\Entity\TeamGameStats;
use App\Entity\PlayerGameStats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TestDataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tsmTeam = new Teams();
        $tsmTeam->setOrganization('Team Solo Mid');
        $tsmTeam->setAbbr('TSM');
        $tsmTeam->setRegion('NA');
        $manager->persist($tsmTeam);

        $tlTeam = new Teams();
        $tlTeam->setOrganization('Team Liquid');
        $tlTeam->setAbbr('TL');
        $tlTeam->setRegion('NA');
        $manager->persist($tlTeam);

        $manager->flush();

        $doubleLift = new Players();
        $doubleLift->setName('doublelift');
        $doubleLift->setTeam($tlTeam);
        $doubleLift->setPosition('ADC');
        $doubleLift->setActive(true);

        $bjergsen = new Players();
        $bjergsen->setName('bjergsen');
        $bjergsen->setTeam($tsmTeam);
        $bjergsen->setPosition('Mid');
        $bjergsen->setActive(true);

        $manager->persist($bjergsen);
        $manager->persist($doubleLift);

        $manager->flush();

        $date = new \DateTime();

        $match = new Matches();
		$match->setSeason(1);
		$match->setWeek(1);
		$match->setBestOf(1);
		$match->setDatePlayed($date);
		$match->setWinner($tsmTeam);
		$match->setLoser($tlTeam);
		$match->setTieBreaker(false);
        $match->setSplit('Spring');
        $match->setTournament(0);
        $match->setTournamentRound(0);

		$manager->persist($match);
		$manager->flush();

		$game = new Games();
		$game->setRedTeam($tlTeam);
		$game->setBlueTeam($tsmTeam);
		$game->setDuration(1250);
		$game->setWinner($tsmTeam);
		$game->setMatch($match);

		$manager->persist($game);
		$manager->flush();

		$teamGameStat = new TeamGameStats();
		$teamGameStat->setTeam($tsmTeam);
		$teamGameStat->setGame($game);
		$teamGameStat->setFirstBlood(true);
		$teamGameStat->setFirstTower(true);
		$teamGameStat->setFirstInhibitor(false);
		$teamGameStat->setFirstDrake(true);
		$teamGameStat->setFirstBaron(false);
		$teamGameStat->setRiftHerald(true);
		$teamGameStat->setFirstElderDrake(false);
		$teamGameStat->setTotalTowers(6);
		$teamGameStat->setTotalDrakes(3);
		$teamGameStat->setTotalInhibitors(3);
		$teamGameStat->setTotalBarons(2);

		$manager->persist($teamGameStat);
		$manager->flush();

		$playerGameStat = new PlayerGameStats();
		$playerGameStat->setPlayer($bjergsen);
		$playerGameStat->setGame($game);
		$playerGameStat->setKills(3);
		$playerGameStat->setAssists(1);
		$playerGameStat->setDeaths(1);
		$playerGameStat->setGold(12222);
		$playerGameStat->setCreepScore(252);
		$playerGameStat->setFirstBlood(true);
		$playerGameStat->setFirstBloodAssist(false);
		$playerGameStat->setFirstDeath(false);
		$playerGameStat->setDamageDealtToChampions(21000);
		$playerGameStat->setVisionScore(31);
		$playerGameStat->setWardsPlaced(11);
		$playerGameStat->setWardsDestroyed(35);
		$playerGameStat->setLargestKillingSpree(3);
		$playerGameStat->setLargestMultiKill(2);
		$playerGameStat->setKillingSprees(1);
		$playerGameStat->setLongestTimeSpentLiving(1111);
		$playerGameStat->setDoubleKills(1);
		$playerGameStat->setTripleKills(0);
		$playerGameStat->setQuadraKills(0);
		$playerGameStat->setPentaKills(0);
		$playerGameStat->setUnrealKills(0);
		$playerGameStat->setTotalDamageDealt(12222);
		$playerGameStat->setMagicDamageDealt(2144);
		$playerGameStat->setPhysicalDamageDealt(35555);
		$playerGameStat->setTrueDamageDealt(256);
		$playerGameStat->setLargestCriticalStrike(888);
		$playerGameStat->setMagicDamageDealtToChampions(154);
		$playerGameStat->setPhysicalDamageDealtToChampions(354);
		$playerGameStat->setTrueDamageDealtToChampions(123);
		$playerGameStat->setTotalHeal(0);
		$playerGameStat->setTotalUnitsHealed(0);
		$playerGameStat->setDamageSelfMitigated(1000);
		$playerGameStat->setDamageDealtToObjectives(0);
		$playerGameStat->setDamageDealtToTurrets(2500);
		$playerGameStat->setTimeCCingOthers(100);
		$playerGameStat->setTotalDamageTaken(25666);
		$playerGameStat->setMagicalDamageTaken(14222);
		$playerGameStat->setPhysicalDamageTaken(5322);
		$playerGameStat->setTrueDamageTaken(655);
		$playerGameStat->setGoldSpent(23012);
		$playerGameStat->setTurretKills(3);
		$playerGameStat->setInhibitorKills(1);
		$playerGameStat->setTotalMinionsKilled(200);
		$playerGameStat->setNeutralMinionsKilled(3);
		$playerGameStat->setNeutralMinionsKilledTeamJungle(3);
		$playerGameStat->setNeutralMinionsKilledEnemyJungle(3);
		$playerGameStat->setTotalTimeCrowdControlDealt(123);
		$playerGameStat->setChampLevel(4);
		$playerGameStat->setVisionWardsBoughtInGame(4);
		$playerGameStat->setSightWardsBoughtInGame(3);
		$playerGameStat->setFirstInhibitorKill(true);
		$playerGameStat->setFirstInhibitorAssist(false);
		$playerGameStat->setFirstTowerKill(true);
		$playerGameStat->setFirstTowerAssist(false);

		$manager->persist($playerGameStat);
		$manager->flush();
	}
}
