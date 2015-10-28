<?php

namespace App\Http\Middleware;

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
        Menu::make('admin', function ($menu) {
            $menu->add(trans('menus.admin.users'), ['route' => ['admin.users.index']])
                 ->data('permission', 'manage-users')
                 ->prepend('<i class="icon user"></i>');
            $menu->add(trans('menus.admin.roles'), ['route' => ['admin.roles.index']])
                 ->data('permission', 'manage-roles')
                 ->prepend('<i class="icon unlock alternate"></i>');
            $menu->add(trans('menus.admin.audit_trail'), ['route' => ['admin.auditTrail.index']])
                 ->data('permission', 'manage-audit-trails')
                 ->prepend('<i class="icon history"></i>');
            $menu->add(trans('menus.admin.settings'), ['route' => ['admin.settings.index']])
                 ->data('permission', 'manage-settings')
                 ->prepend('<i class="icon options"></i>');
        })->filter(function ($item) {
            return auth()->user()->can($item->data('permission'));
        });
    }

    protected function menuMember()
    {
        Menu::make('member', function ($menu) {
            $menu->add(trans('menus.member.settings'), url('my/profile'));
            $menu->divide();
            $menu->add(trans('menus.member.logout'), url('auth/logout'));
        });

    }
}
