<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 11/4/18
 * Time: 19:02
 */

namespace App\controller;


use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginPageController
{
    protected $container;

    public function  __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function loginAction(Request $request, Response $response, array $args)
    {
        return $this->container->get('view')->render($response, 'menu.twig', []);
    }

    public function crearMenuAction(Request $request, Response $response, array $args)
    {

        $plat_useCase = $this->container->get('post_plat_use_case');
        if (isset($args["what"])) {
            switch ($args["what"]) {

                case "segons":
                    $title = "Segons Plats";
                    $dishes = $plat_useCase->get_dishes_with_option(2);
                    break;
                case "postres":
                    $title = "Postres";
                    $dishes = $plat_useCase->get_dishes_with_option(3);
                    break;
                case "sugg":
                    $title = "Plats de Suggeriments";
                    $dishes = $plat_useCase->get_dishes_with_option(4);
                    break;
                case "vins":
                    $title = "Vins";
                    break;
                case "primers":
                    $title = "Primers Plats";
                    $dishes = $plat_useCase->get_dishes_with_option(1);
                default:

                    break;

            }
        } else {
            $title = "Primers Plats";
            $dishes = $plat_useCase->get_dishes_with_option(1);
        }

        return $this->container->get('view')->render($response, 'crearMenu.twig', ['title' => $title, 'dishes' => $dishes]);
    }

    public function gestioPlatsAction(Request $request, Response $response, array $args)
    {
        $plat_useCase = $this->container->get('post_plat_use_case');
        $dishes = $plat_useCase->get_dishes();

        return $this->container->get('view')->render($response, 'gestionarPlats.twig', [
            'dishes' => $dishes

        ]);
    }


    //Per defecte si a routes.php no especifiques l'action s'invoca el __invoke, en cas que s'especifiqui invoca l'especificat...indexAction
    public function __invoke(Request $request, Response $response, array $args)
    {


        return $this->container->get('view')->render($response, 'login.twig', []);
    }
}