<?php
namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static UserStatus PENDING()
 * @method static UserStatus ACTIVE()
 * @method static UserStatus BLOCKED()
 */
class FaseType extends Enum
{
    const PERENCANAAN = 'PERENCANAAN';
    const PELAKSANAAN = 'PELAKSANAAN';
    const PENGAWASAN = 'PENGAWASAN';
}
