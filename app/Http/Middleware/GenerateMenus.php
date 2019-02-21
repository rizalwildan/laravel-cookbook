<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
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
        \Menu::make('sidebar', function ($menu) {
            $menu->add('User', ['route' => 'admin.users.index']);
            $menu->add('Recipe', ['route' => 'admin.recipe.index']);
            $menu->add('Ingredients', ['route' => 'admin.ingredient.index']);
            $menu->add('Categories', ['route' => 'admin.category.index']);
        });
        return $next($request);
    }
}
