<?php

namespace App\Validator\Teams;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Teams validator.
 */
class TeamsValidator
{
	/**
	 * @Assert\Type("string")
	 */
	public $organization;

	/**
	 * @Assert\Type("string")
	 */
	public $abbr;

	/**
	 * @Assert\Type("string")
	 */
	public $region;
}
