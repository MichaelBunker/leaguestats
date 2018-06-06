<?php

namespace App\Validator\Stats\Average;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * TeamGameStatsAverage validator.
 */
class TeamGameStatsAverageValidator
{
	/**
	 * @Assert\Type("string")
	 */
	public $team;

	/**
	 * @Assert\Type("float")
	 */
	public $winPercentage;

	/**
	 * @Assert\Type("float")
	 */
	public $kills;

	/**
	 * @Assert\Type("float")
	 */
	public $assists;

	/**
	 * @Assert\Type("float")
	 */
	public $deaths;

	/**
	 * @Assert\Type("float")
	 */
	public $wardsPlaced;

	/**
	 * @Assert\Type("float")
	 */
	public $damageDealt;
}
