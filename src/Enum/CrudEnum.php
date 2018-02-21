<?php

namespace App\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Enumeration for CRUD methods.
 *
 * @method static CrudEnum CREATE()
 * @method static CrudEnum DELETE()
 * @method static CrudEnum READ()
 * @method static CrudEnum UPDATE()
 */
class CrudEnum extends AbstractEnumeration
{
    const CREATE = 'create';
    const READ   = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';
}
