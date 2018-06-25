<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get(
    '/',
    'src\controller\LandingPageController'
);

$app->post(
    '/',
    'Pwbox\controller\LandingController:updateAction'
);

