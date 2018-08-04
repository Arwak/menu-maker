<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get(
    '/',
    'App\controller\LandingPageController'
);

$app->get(
    '/login',
    'App\controller\LoginPageController'
);

$app->post(
    '/login',
    'App\controller\LoginPageController:loginAction'
);

$app->get(
    '/crearMenu',
    'App\controller\LoginPageController:crearMenuAction'
);


$app->get(
    '/gestionarPlats',
    'App\controller\LoginPageController:gestioPlatsAction'
);

$app->post(
    '/',
    'App\controller\LandingController:updateAction'
);

$app->post(
    '/save_dish',
    'App\controller\LandingPageController:saveDishAction'
);

