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
        var_dump($_POST);
        var_dump($args);
        if (isset($_POST['cat_name']) && isset($_POST['esp_name']) &&
            isset($_POST['ordre_plat']) && isset($_POST['tag'])
            ) {

            if (!isset($_POST['alias']) || strlen($_POST['alias']) < 1) {
                $alias = $_POST['cat_name'];
            } else {
                $alias = $_POST['alias'];
            }

            $names[0]['dish_name'] = $_POST['cat_name'];
            $names[0]['dish_description'] = $_POST['cat_name'];
            $names[0]['id_language'] = 1;
            $names[1]['dish_name']  = $_POST['esp_name'];
            $names[1]['dish_description'] = $_POST['esp_name'];
            $names[1]['id_language'] = 2;

            if (isset($_POST['eng_name'])) {
                $names[2]['dish_name']  = $_POST['eng_name'];
                $names[2]['dish_description'] = $_POST['eng_name'];
                $names[2]['id_language'] = 3;
            }
            $allergens[0] = null;
            $j = 0;
            for ($i = 0; $i < 15; $i++) {
                if ( isset($_POST[$i]))
                    $allergens[$j++] = $i;
            }

            $plat = new Plat($_POST['id'], $alias, $names, $_POST['ordre_plat'], $allergens, $_POST['tag'], strlen($_POST['cost_price'])==0?null:$_POST['cost_price'], strlen($_POST['net_price'])==0?null:$_POST['net_price']);

            $plat_useCase = $this->container->get('post_plat_use_case');


            /*
            if ($_POST['id'] != 0) {

                if ($plat_useCase->update_dish($plat)) {

                } else {

                }

            } else {

                if ($plat_useCase->save_dish($plat)) {

                } else {

                }

            }*/
            $plat_useCase->save_dish($plat);



            $plat_useCase = $this->container->get('post_plat_use_case');
            $dishes = $plat_useCase->get_dishes();

            $result = array("new_dish" => var_dump($dishes));
            echo json_encode($result);
            //return $this->container->get('view')->render($response, 'gestionarPlats.twig', ['dishes' => $dishes]);
        } else {
            $plat_useCase = $this->container->get('post_plat_use_case');
            $dishes = $plat_useCase->get_dishes();
            $result = array("new_dish" => $dishes[0]);
            echo json_encode($result);
            //return $this->container->get('view')->render($response, 'gestionarPlats.twig', ['dishes' => $dishes]);
        }


    }




    public function loadDishAction(Request $request, Response $response, array $args)
    {

        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $plat_useCase = $this->container->get('post_plat_use_case');
            $dish = $plat_useCase->get_dish($id);
            echo json_encode($dish->make_array());

        }

    }


    //Per defecte si a routes.php no especifiques l'action s'invoca el __invoke, en cas que s'especifiqui invoca l'especificat...indexAction
    public function __invoke(Request $request, Response $response, array $args)
    {


        return $this->container->get('view')->render($response, 'menu.twig', []);
    }
}