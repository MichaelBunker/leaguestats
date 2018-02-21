<?php

namespace App\Validator\Games;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Games validator.
 */
class GamesValidator
{
	/**
	 * @Assert\Type("integer")
	 */
	public $season;

	/**
	 * @Assert\Type("string")
	 */
	public $redTeam;

	/**
	 * @Assert\Type("integer")
	 */
	public $blueTeam;

	/**
	 * @Assert\Type("integer")
	 */
	public $duration;

	/**
	 * @Assert\Type("string")
	 */
	public $winner;
}
