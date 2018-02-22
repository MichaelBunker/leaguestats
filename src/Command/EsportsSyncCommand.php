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
	protected static $defaultName = 'esports-sync';
	/**
	 * @var WeeklyStats
	 */
	protected $weeklyStats;

	/**
	 * @var EntityManagerInterface
	 */
	protected $em;

	public function __construct($name = null, WeeklyStats $weeklyStats, EntityManagerInterface $em)
	{
		parent::__construct($name);
		$this->weeklyStats = $weeklyStats;
		$this->em = $em;
	}

	protected function configure()
	{
		$this
			->setDescription('Esports data sync command. Provide the teams and resource for data.')
			->addOption('redTeam', 'rt', InputOption::VALUE_REQUIRED)
			->addOption('blueTeam', 'bt', InputOption::VALUE_REQUIRED)
			->addOption('date', 'd', InputOption::VALUE_REQUIRED)
			->addOption('resource', 'rsrc', InputOption::VALUE_REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		$repository = $this->em->getRepository(Teams::class);
		$redTeam    = $repository->findOneBy(['abbr' => $input->getOption('redTeam')]);
		$blueTeam   = $repository->findOneBy(['abbr' => $input->getOption('blueTeam')]);

		$this->weeklyStats($input->getOption('resource'), $blueTeam, $redTeam, new \DateTime($input->getOption('resource')));

		$io->success(sprintf('Stats Synced for given match between %s and %s', $redTeam->getAbbr(), $blueTeam->getAbbr()));
	}
}