<?php

namespace App\Integration;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Interface for integration models.
 */
interface ModelInterface
{
	/**
	 * Create.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException If the operation is not available for the integration.
	 *
	 * @return string
	 */
	public function create(object $entity);

	/**
	 * Fetch records.
	 *
	 * @param Criteria $criteria
	 *
	 * @throws NotImplementedException If the operation is not available for the integration.
	 *
	 * @return ArrayCollection
	 */
	public function read(Criteria $criteria): ArrayCollection;

	/**
	 * Update a record.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException If the operation is not available for the integration.
	 *
	 * @return string
	 */
	public function update(object $entity);

	/**
	 * Remove a given record.
	 *
	 * @param object $entity
	 *
	 * @throws NotImplementedException If the operation is not available for the integration.
	 *
	 * @return string
	 */
	public function delete(object $entity);
}
