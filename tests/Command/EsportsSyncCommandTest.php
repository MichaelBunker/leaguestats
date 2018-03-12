<?php

namespace tests\Command;

use App\Command\EsportsSyncCommand;
use App\Entity\Teams;
use App\Util\Esports\Sync\WeeklyStats;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\PeekAndPoke\Proxy;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EsportsSyncCommandTest extends TestCase
{
	/**
	 * Test the constructor() function.
	 */
	public function testConstructor()
	{
		$weeklyStats = $this->createMock(WeeklyStats::class);
		$em          = $this->createMock(EntityManagerInterface::class);
		$command     = $this->createPartialMock(EsportsSyncCommand::class, []);
		$accessor    = new Proxy($command);

		$accessor->__call('__construct', [null, $weeklyStats, $em]);

		$this->assertSame($weeklyStats, $accessor->weeklyStats);
		$this->assertSame($em, $accessor->em);
	}

	/**
	 * Test the configure() function.
	 */
	public function testConfigure()
	{
		$command  = $this->createPartialMock(EsportsSyncCommand::class, ['setDescription', 'addOption']);
		$accessor = new Proxy($command);

		$command
			->expects($this->once())
			->method('setDescription')
			->with('Esports data sync command. Provide the teams and resource for data.')
			->willReturnSelf();

		$command
			->expects($this->exactly(4))
			->method('addOption')
			->withConsecutive(
				['redTeam', 'rt', InputOption::VALUE_REQUIRED],
				['blueTeam', 'bt', InputOption::VALUE_REQUIRED],
				['date', 'd', InputOption::VALUE_REQUIRED],
				['resource', 'rsrc', InputOption::VALUE_REQUIRED]
			)
			->willReturnSelf();

		$this->assertNull($accessor->configure());
	}

	/**
	 * Test the execute() function.
	 */
	public function testExecute()
	{
		$redTeam = $this->createMock(Teams::class);
		$blueTeam = $this->createMock(Teams::class);
		$repo = $this->createMock(ObjectRepository::class);
		$io = $this->createMock(SymfonyStyle::class);
		$em = $this->createMock(EntityManagerInterface::class);
		$weeklyStats = $this->createMock(WeeklyStats::class);
		$input = $this->createMock(InputInterface::class);
		$output = $this->createMock(OutputInterface::class);
		$command = $this->createPartialMock(EsportsSyncCommand::class, ['setDescription', 'addOption', 'getSymfonyIO']);
		$accessor = new Proxy($command);
		$accessor->em = $em;
		$accessor->weeklyStats = $weeklyStats;

		$redTeamAbbr = 'Hondo';
		$blueTeamAbbr = 'Havlicek';
		$date = '2012-01-22';
		$resource = '/fake/resource';

		$command
			->expects($this->once())
			->method('getSymfonyIO')
			->with($input, $output)
			->willReturn($io);

		$em
			->expects($this->once())
			->method('getRepository')
			->with(Teams::class)
			->willReturn($repo);

		$input
			->expects($this->exactly(4))
			->method('getOption')
			->will($this->returnValueMap(
			   [
				   ['redTeam', $redTeamAbbr],
				   ['blueTeam', $blueTeamAbbr],
				   ['resource', $resource],
				   ['date', $date]
			   ]
			));

		$repo
			->expects($this->exactly(2))
			->method('findOneBy')
			->will($this->returnValueMap(
				[
					[['abbr' => $redTeamAbbr], $redTeam],
					[['abbr' => $blueTeamAbbr], $blueTeam]
				]
			));

		$weeklyStats
			->expects($this->once())
			->method('getWeeklyStats')
			->with($resource, $blueTeam, $redTeam, new \DateTime($date));

		$redTeam
			->expects($this->once())
			->method('getAbbr')
			->with()
			->willReturn('Celtics');

		$blueTeam
			->expects($this->once())
			->method('getAbbr')
			->with()
			->willReturn('Lakers');

		$io
			->expects($this->once())
			->method('success')
			->with('Stats Synced for given match between Celtics and Lakers');

		$this->assertNull($accessor->execute($input, $output));
	}
}
