<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 11/4/18
 * Time: 19:02
 */

namespace menumaker\controller;


use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HelloController
{
    protected $container;

    public function  __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function indexAction(Request $request, Response $response, array $args)
    {
        return $this->container->get('view')->render($response, 'menu.twig', []);
    }


    //Per defecte si a routes.php no especifiques l'action s'invoca el __invoke, en cas que s'especifiqui invoca l'especificat...indexAction
    public function __invoke(Request $request, Response $response, array $args)
    {


        return $this->container->get('view')->render($response, 'menu.twig', []);
    }
}