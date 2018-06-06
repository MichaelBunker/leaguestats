<?php

namespace App\Validator\Stats;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlayerGameStats validator.
 */
class PlayerGameStatsValidator
{
	/**
	 * @Assert\Type("string")
	 */
	public $player;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstBlood;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstDeath;

	/**
	 * @Assert\Type("integer")
	 */
	public $creepScore;

	/**
	 * @Assert\Type("integer")
	 */
	public $kills;

	/**
	 * @Assert\Type("integer")
	 */
	public $assists;

	/**
	 * @Assert\Type("integer")
	 */
	public $deaths;

	/**
	 * @Assert\Type("integer")
	 */
	public $gold;
}
