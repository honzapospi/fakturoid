<?php

// The Nette Tester command-line runner can be
// invoked through the command: ../vendor/bin/tester .
if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

$configurator = new Nette\Configurator;
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__.'/../app')
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/../app/config/config.neon');

$container = $configurator->createContainer();

return $container;
