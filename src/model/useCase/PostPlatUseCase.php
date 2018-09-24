<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 4/8/18
 * Time: 17:38
 */

namespace App\model\useCase;

use App\model\Plat;
use App\model\PlatRepository;


class PostPlatUseCase
{

    private $repo;

    public function __construct(PlatRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke()
    {

    }

    public function save_dish(Plat $plat)
    {
        return $this->repo->save_dish($plat);
    }

    public function update_dish(Plat $plat)
    {
        return $this->repo->update_dish($plat);
    }


    public function get_dishes()
    {
        return $this->repo->get_dishes();
    }


    public function get_dish($id)
    {
        return $this->repo->get_dish($id);
    }


    public function get_dishes_with_option($postion)
    {
        return $this->repo->get_dishes_with_option($postion);
    }

}