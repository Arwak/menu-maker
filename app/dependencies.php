<?php


use Slim\Container;

$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../src/view/templates', [
        /*'cache' => __DIR__ . '/../var/cache/'*/
    ]);
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};

$container['test'] = function () {
    echo "test";
};

$container['doctrine'] = function ($container) {
    $config = new \Doctrine\DBAL\Configuration();
    $conn = \Doctrine\DBAL\DriverManager::getConnection(
        $container->get('settings')['database'],
        $config
    );
    return $conn;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};

$container['plat_repository'] = function($container) {
    $repository = new App\model\implementation\DoctrinePlatRepository(
        $container->get('doctrine')
    );
    return $repository;
};

$container['post_plat_use_case'] = function ($container) {
    $useCase = new App\model\useCase\PostPlatUseCase(
        $container->get('plat_repository')
    );

    return $useCase;
};