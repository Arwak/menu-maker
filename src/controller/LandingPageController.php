<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 11/4/18
 * Time: 19:02
 */

namespace App\controller;


use App\model\Plat;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LandingPageController
{
    protected $container;

    public function  __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function indexAction(Request $request, Response $response, array $args)
    {
        return $this->container->get('view')->render($response, 'menu.twig', []);
    }


    public function saveDishAction(Request $request, Response $response, array $args)
    {
        if (isset($_POST['cat_name']) && isset($_POST['esp_name']) &&
            isset($_POST['ordre_plat']) && isset($_POST['tag']) && isset($_POST['cost_price'])
            ) {

            if (!isset($_POST['alias']) || strlen($_POST['alias']) < 1) {
                $alias = $_POST['cat_name'];
            } else {
                $alias = $_POST['alias'];
            }


            $names[0] = $_POST['cat_name'];
            $names[1] = $_POST['esp_name'];

            if (isset($_POST['eng_name'])) {
                $names[2] = $_POST['eng_name'];
            }

            $j = 0;
            for ($i = 0; $i < 15; $i++) {
                if ( isset($_POST[$i]))
                    $allergens[$j++] = $i;
            }

            $plat = new Plat($_POST['id'], $alias, $names, $_POST['ordre_plat'], $allergens, $_POST['tag'], $_POST['cost_price']);

            $plat_useCase = $this->container->get('post_plat_use_case');

            if ($_POST['id'] != 0) {

                if ($plat_useCase->update_dish($plat)) {

                } else {

                }

            } else {

                if ($plat_useCase->save_dish($plat)) {

                } else {

                }

            }





            return "OK";
        } else {
            return "KO";
        }


    }


    //Per defecte si a routes.php no especifiques l'action s'invoca el __invoke, en cas que s'especifiqui invoca l'especificat...indexAction
    public function __invoke(Request $request, Response $response, array $args)
    {


        return $this->container->get('view')->render($response, 'menu.twig', []);
    }
}