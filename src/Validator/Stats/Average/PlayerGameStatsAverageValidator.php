<?php

namespace App\Validator\Stats\Average;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlayerGameStatsAverage validator.
 */
class PlayerGameStatsAverageValidator
{
	/**
	 * @Assert\Type("string")
	 */
	public $player;

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

	/**
	 * @Assert\Type("float")
	 */
	public $gold;

	/**
	 * @Assert\Type("float")
	 */
	public $creepScore;

	/**
	 * @Assert\Type("float")
	 */
	public $visionScore;
}
