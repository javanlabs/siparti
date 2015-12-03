<?php
namespace App\Enum;

use MyCLabs\Enum\Enum;

class Permission extends Enum
{
    const ACCESS_BACKEND = 'access-backend';
    const MANAGE_USER = 'manage-user';
    const MANAGE_ROLE = 'manage-role';
    const MANAGE_SETTING = 'manage-setting';
    const VIEW_AUDIT_TRAIL = 'view-audit-trail';
    const MANAGE_PROGRAM_KERJA = 'manage-program-kerja';
    const MANAGE_UJI_PUBLIK = 'manage-uji-publik';
    const MANAGE_USULAN = 'manage-usulan';
    const MANAGE_SATUAN_KERJA = 'manage-satuan-kerja';
    const MANAGE_COMMENT = 'manage-comment';
    const VIEW_LOG = 'view-log';
    const VIEW_DASHBOARD = 'view-dashboard';
    const MANAGE_CATEGORY = 'manage-category';
}
