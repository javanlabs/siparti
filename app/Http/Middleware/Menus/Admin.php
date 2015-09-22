<?php

namespace App\Http\Middleware\Menus;

use Closure;
use Menu;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('admin.users.manage', function($menu) {
            $menu->add(trans('menus.users.manage.profile'), ['route' => ['admin.profile.edit', $id]]);
            $menu->add(trans('menus.users.manage.account'), ['route' => ['admin.profile.edit', $id]]);
            $menu->add(trans('menus.users.manage.password'), ['route' => ['admin.profile.edit', $id]]);
        });

        return $next($request);
    }
}
