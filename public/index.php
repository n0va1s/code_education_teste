<?php
require __DIR__.'/../bootstrap.php';

use Symfony\Component\HttpFoundation\Response;

$app->get('/', function () use ($app) {
    return $app['twig']->render('inicio.twig');
})->bind('inicio');

$app->run();
