<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
	public static function boot(): Configurator
	{
		return self::createConfigurator(
			true
		);
	}

	public static function bootForCli(): Configurator
	{
		$isDebug = isset($_SERVER['argv']) && in_array('--debug', $_SERVER['argv'], true);

		return self::createConfigurator($isDebug);
	}

	private static function createConfigurator(bool|string|array $debugMode): Configurator
	{
		$configurator = new Configurator;
		$rootDir = dirname(__DIR__);

		$configurator->setDebugMode($debugMode);
		$configurator->enableTracy($rootDir . '/log', 'admin@localhost');
		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($rootDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($rootDir . '/config/common.neon');
		$configurator->addConfig($rootDir . '/config/local.neon');

		return $configurator;
	}

}
