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
    private $cost_price;
    private $benefits;
    private $net_price;
    private $course_pos;
    private $tag;
    private $allergens;
    private $languages;


    public function __construct(

        $id_dish,
        $alias,
        $languages,
        $course_pos,
        $allergens,
        $tag,
        $cost_price,
        $net_price
    ) {
        $this->id_dish = $id_dish;
        $this->alias = $alias;
        $this->languages = $languages;
        $this->cost_price = $cost_price;
        $this->net_price = $net_price;
        $this->course_pos = $course_pos;
        $this->tag = $tag;
        $this->allergens = $allergens;

    }

    /**
     * @return mixed
     */
    public function get_id_Dish()
    {
        return $this->id_dish;
    }

    /**
     * @return mixed
     */
    public function get_alias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function get_languages()
    {
        return $this->languages;
    }

    /**
     * @return mixed
     */
    public function get_cost_price()
    {
        return $this->cost_price;
    }

    /**
     * @return mixed
     */
    public function get_benefits()
    {
        return $this->benefits;
    }

    /**
     * @return mixed
     */
    public function get_net_price()
    {
        return $this->net_price;
    }

    /**
     * @return mixed
     */
    public function get_course_pos()
    {
        return $this->course_pos;
    }

    /**
     * @return mixed
     */
    public function get_tag()
    {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function get_allergens()
    {
        return $this->allergens;
    }

    /**
     * @return array
     */
    public function make_array() {

        return array(
            "id_dish" => $this->id_dish,
            "alias" => $this->alias,
            "cost_price" => $this->cost_price,
            "benefits" => $this->benefits,
            "net_price" => $this->net_price,
            "course_pos" => $this->course_pos,
            "tag" => $this->tag,
            "allergens" => $this->allergens,
            "languages" => $this->languages);


    }


}