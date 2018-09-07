<?php

namespace App\Command;

use App\Entity\Teams;
use App\Util\Esports\Sync\WeeklyStats;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class EsportsSyncCommand for getting up to date data.
 *
 * Ex.
 * php bin/console esports-sync --redTeam=TSM --blueTeam=CLG --resource=asf/asdf --date=2017-01-20
 */
class EsportsSyncCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'esports-sync';

	/**
	 * @var WeeklyStats
	 */
	protected $weeklyStats;

	/**
	 * @var EntityManagerInterface
	 */
	protected $em;
// phpcs:disable
	/**
	 * EsportsSyncCommand constructor.
	 *
	 * @param string                 $name
	 * @param WeeklyStats            $weeklyStats
	 * @param EntityManagerInterface $em
	 */
	public function __construct($name = null, WeeklyStats $weeklyStats, EntityManagerInterface $em)
	{
		parent::__construct($name);
		$this->weeklyStats = $weeklyStats;
		$this->em          = $em;
	}
// phpcs:enable
	/**
	 * Configure command.
	 *
	 * @return void
	 */
	protected function configure()
	{
		$this
			->setDescription('Esports data sync command. Provide the teams and resource for data.')
			->addOption('redTeam', 'rt', InputOption::VALUE_REQUIRED)
			->addOption('blueTeam', 'bt', InputOption::VALUE_REQUIRED)
			->addOption('date', 'd', InputOption::VALUE_REQUIRED)
			->addOption('resource', 'rsrc', InputOption::VALUE_REQUIRED);
	}

	/**
	 * Execute command.
	 *
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = $this->getSymfonyIO($input, $output);

		$repository = $this->em->getRepository(Teams::class);
		$redTeam    = $repository->findOneBy(['abbr' => $input->getOption('redTeam')]);
		$blueTeam   = $repository->findOneBy(['abbr' => $input->getOption('blueTeam')]);

		$this->weeklyStats->getWeeklyStats($input->getOption('resource'), $blueTeam, $redTeam, new \DateTime($input->getOption('date')));

		$io->success(sprintf('Stats Synced for given match between %s and %s', $redTeam->getAbbr(), $blueTeam->getAbbr()));
	}

	/**
	 * Get SymfonyStyle instance.
	 *
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return SymfonyStyle
	 *
	 * @codeCoverageIgnore
	 */
	protected function getSymfonyIO(InputInterface $input, OutputInterface $output)
	{
		return new SymfonyStyle($input, $output);
	}
}
