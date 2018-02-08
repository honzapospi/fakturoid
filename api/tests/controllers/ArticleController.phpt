<?php

/**
 * @var \Nette\DI\Container $container
 */
$container = require(__DIR__.'/../bootstrap.php');

$parameters = new \Tests\Parameters();
$response = new \RestServer\Response();
$articleController = $container->getByType(\App\Controllers\ArticleController::class);

$articleController->run($parameters, $response);

\Tester\Assert::true($response->data['data'][0]['id'] === 1);
