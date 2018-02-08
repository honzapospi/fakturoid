<?php

$container = require __DIR__ . '/../app/bootstrap.php';
$app = $container->getByType(\RestServer\Application::class);
$app->catchExceptions = TRUE;
$app->run();
