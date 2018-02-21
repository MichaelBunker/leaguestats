<?php

namespace App\Validator\Matches;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Matches validator.
 */
class MatchesValidator
{
	/**
	 * @Assert\Type("integer")
	 */
	public $season;

	/**
	 * @Assert\Type("integer")
	 */
	public $week;

	/**
	 * @Assert\Type("integer")
	 */
	public $bestOf;

	/**
	 * @Assert\Date()
	 */
	public $datePlayed;

	/**
	 * @Assert\Type("string")
	 */
	public $split;

	/**
	 * @Assert\Type("string")
	 */
	public $winner;

	/**
	 * @Assert\Type("string")
	 */
	public $loser;
}
