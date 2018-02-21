<?php

namespace App\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * HTTP Enum.
 *
 * @method static HttpEnum OPTIONS()
 * @method static HttpEnum GET()
 * @method static HttpEnum HEAD()
 * @method static HttpEnum POST()
 * @method static HttpEnum PUT()
 * @method static HttpEnum DELETE()
 */
class HttpEnum extends AbstractEnumeration
{
	const OPTIONS = 'OPTIONS';
	const GET     = 'GET';
	const HEAD    = 'HEAD';
	const POST    = 'POST';
	const PUT     = 'PUT';
	const DELETE  = 'DELETE';
}
