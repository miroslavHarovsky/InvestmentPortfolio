<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

    /**
     * @return \Nette\Application\Routers\RouteList
     */
    public static function createRouter()
    {
        $router = new RouteList();

        $router[] = new Route(



            'admin/<presenter>/<action>', [
                'presenter' => [
                    Route::VALUE        => 'Homepage',
                ],
                'action'    => 'default',
                'module'    => 'Admin',
            ]
        );

        $router[] = new Route(
            '<presenter>/<action>', [
                'presenter' => [
                    Route::VALUE        => 'Homepage',
                ],
                'action'    => 'default',
                'module'    => 'Front',
            ]
        );

        return $router;
    }
}
