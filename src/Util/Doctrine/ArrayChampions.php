<?php

namespace App\Util\Doctrine;

use App\Entity\Champions;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Custom Doctrine Type for postgres Array of integers. Used for bans in matches.
 */
class ArrayChampions extends Type
{
	const ARRAY_CHAMPIONS = 'integer[]';

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return static::ARRAY_CHAMPIONS;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return $platform->getDoctrineTypeMapping(static::ARRAY_CHAMPIONS);
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToDatabaseValue($array, AbstractPlatform $platform)
	{
		if ($array === null) {
			return;
		}

		$championArray = [];

		foreach ($array as $champion) {
			if ($champion instanceof Champions::class) {
				$championArray[] = $champion->getChampionId();
				continue;
			}

			if (!is_numeric($champion)) {
				continue;
			}

			$championArray[] = (int) $champion;
		}

		return sprintf('{%s}', implode(',', $championArray));
	}

	/**
	 * {@inheritdoc}
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ($value === null) {
			return;
		}

		$value = ltrim(rtrim($value, '}'), '{');

		return $value == ''
			? []
			: explode(',', $value);
	}
}
