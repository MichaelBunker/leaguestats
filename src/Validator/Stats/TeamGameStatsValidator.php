<?php

namespace App\Validator\Stats;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * TeamGameStats validator.
 */
class TeamGameStatsValidator
{
	/**
	 * @Assert\Type("string")
	 * @Assert\NotBlank(groups={"GET"})
	 */
	public $team;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstBlood;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstTower;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstInhibitor;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstBaron;

	/**
	 * @Assert\Type("boolean")
	 */
	public $riftHerald;

	/**
	 * @Assert\Type("boolean")
	 */
	public $firstElderDrake;

	/**
	 * @Assert\Type("integer")
	 */
	public $totalDrakes;

	/**
	 * @Assert\Type("integer")
	 */
	public $totalTowers;

	/**
	 * @Assert\Type("integer")
	 */
	public $totalInhibitors;

	/**
	 * @Assert\Type("integer")
	 */
	public $totalBarons;
}
