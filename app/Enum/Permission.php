<?php
namespace App\Enum;

use MyCLabs\Enum\Enum;

class Permission extends Enum
{
    const MANAGE_USER = 1;
    const MANAGE_ROLE = 2;
    const MANAGE_SETTING = 3;
    const VIEW_AUDIT_TRAIL = 4;
    const MANAGE_PROGRAM_KERJA = 5;
    const MANAGE_UJI_PUBLIK = 6;
    const MANAGE_USULAN = 7;
    const MANAGE_SATUAN_KERJA = 8;
    const MANAGE_COMMENT = 9;
    const VIEW_LOG = 10;
}
