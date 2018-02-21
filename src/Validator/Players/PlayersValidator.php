<?php

namespace App\Validator\Players;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Players validator.
 */
class PlayersValidator
{
	/**
	 * @Assert\Type("string")
	 */
	public $name;

	/**
	 * @Assert\Type("string")
	 */
	public $position;

	/**
	 * @Assert\Type("boolean")
	 */
	public $active;

	/**
	 * @Assert\Type("string")
	 */
	public $team;
}
