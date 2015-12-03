<?php

namespace App\Http\Middleware;

use App\Enum\Permission;
use Closure;
use Menu;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $this->menuAdmin();
            $this->menuMember();
        }

        return $next($request);
    }

    protected function menuAdmin()
    {
        Menu::make('admin-administration', function ($menu) {
            $menu->add(trans('menus.admin.users'), ['route' => ['admin.users.index']])
                 ->data('permission', Permission::MANAGE_USER)
                 ->prepend('<i class="icon user"></i>');
            $menu->add(trans('menus.admin.roles'), ['route' => ['admin.roles.index']])
                 ->data('permission', Permission::MANAGE_ROLE)
                 ->prepend('<i class="icon unlock alternate"></i>');
            $menu->add(trans('menus.admin.audit_trail'), ['route' => ['admin.auditTrail.index']])
                 ->data('permission', Permission::VIEW_AUDIT_TRAIL)
                 ->prepend('<i class="icon history"></i>');
            $menu->add(trans('menus.admin.settings'), ['route' => ['admin.settings.index']])
                 ->data('permission', Permission::MANAGE_SETTING)
                 ->prepend('<i class="icon options"></i>');
            $menu->add(trans('menus.admin.manage_log'), ['route' => ['admin.logs.index']])
                 ->data('permission', Permission::VIEW_LOG)
                 ->prepend('<i class="sidebar icon"></i>');

        })->filter(function ($item) {
            return auth()->user()->can($item->data('permission'));
        });

        Menu::make('admin-content', function ($menu) {
            $menu->add(trans('menus.admin.manage_program_kerja'), ['route' => ['admin.programKerja.index']])
                 ->data('permission', Permission::MANAGE_PROGRAM_KERJA)
                 ->prepend('<i class="configure icon"></i>');
            $menu->add(trans('menus.admin.manage_fase_program_kerja'), ['route' => ['admin.faseProgramKerja.index']])
                 ->data('permission', Permission::MANAGE_PROGRAM_KERJA)
                 ->prepend('<i class="wait icon"></i>');
            $menu->add(trans('menus.admin.manage_program_kerja_usulan'),
                ['route' => ['admin.programKerjaUsulan.index']])
                 ->data('permission', Permission::MANAGE_USULAN)
                 ->prepend('<i class="announcement icon"></i>');
            $menu->add(trans('menus.admin.uji_publik'), ['route' => ['admin.ujiPublik.index']])
                 ->data('permission', Permission::MANAGE_UJI_PUBLIK)
                 ->prepend('<i class="book icon"></i>');
            $menu->add(trans('menus.admin.manage_comments'), ['route' => ['admin.comments.index']])
                 ->data('permission', Permission::MANAGE_COMMENT)
                 ->prepend('<i class="comments icon"></i>');
        })->filter(function ($item) {
            return auth()->user()->can($item->data('permission'));
        });

        Menu::make('admin-master', function ($menu) {
            $menu->add(trans('menus.admin.category'), ['route' => ['admin.category.index']])
                 ->data('permission', Permission::MANAGE_CATEGORY)
                 ->prepend('<i class="icon list"></i>');
            $menu->add(trans('menus.admin.satuan_kerja'), ['route' => ['admin.satuanKerja.index']])
                 ->data('permission', Permission::MANAGE_SATUAN_KERJA)
                 ->prepend('<i class="sitemap icon"></i>');
        })->filter(function ($item) {
            return auth()->user()->can($item->data('permission'));
        });
    }

    protected function menuMember()
    {
        Menu::make('member', function ($menu) {
            $menu->add(trans('menus.admin.admin_panel'), route('admin.home'))->data('permission', Permission::ACCESS_BACKEND);
            $menu->divide();
            $menu->add(trans('menus.member.settings'), url('my/profile'));
            $menu->divide();
            $menu->add(trans('menus.member.my_program_kerja_usulan'), url('my/usulan'));
            $menu->add(trans('menus.member.logout'), url('auth/logout'));
        })->filter(function ($item) {
            return auth()->user()->can($item->data('permission'));
        });;

    }
}
