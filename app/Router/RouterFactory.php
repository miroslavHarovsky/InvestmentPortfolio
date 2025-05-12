<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

    public static function createRouter(): RouteList
	{
        $router = new RouteList();

        $router[] = new Route(

            'admin/<presenter>/<action>', [
                'presenter' => [
					Nette\Routing\Route::Value => 'Homepage',
                ],
                'action'    => 'default',
                'module'    => 'Admin',
            ]
        );

        $router[] = new Route(
            '<presenter>/<action>', [
                'presenter' => [
					Nette\Routing\Route::Value => 'Homepage',
                ],
                'action'    => 'default',
                'module'    => 'Front',
            ]
        );

        return $router;
    }
}
