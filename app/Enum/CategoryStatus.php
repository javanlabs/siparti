<?php
namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static UserStatus INACTIVE()
 * @method static UserStatus ACTIVE()
 */
class CategoryStatus extends Enum
{
    const INACTIVE = 'INACTIVE';
    const ACTIVE = 'ACTIVE';
}
