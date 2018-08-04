<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 4/8/18
 * Time: 17:36
 */

namespace App\model;


class Plat
{


    private $id_dish;
    private $alias;
    private $names;
    private $cost_price;
    private $benefits;
    private $net_price;
    private $course_pos;
    private $tag;
    private $allergens;


    public function __construct(

        $id_dish,
        $alias,
        $names,
        $course_pos,
        $allergens,
        $tag,
        $cost_price
    ) {
        $this->id_dish = $id_dish;
        $this->alias = $alias;
        $this->names = $names;
        $this->cost_price = $cost_price;
        $this->course_pos = $course_pos;
        $this->tag = $tag;
        $this->allergens = $allergens;

    }


}