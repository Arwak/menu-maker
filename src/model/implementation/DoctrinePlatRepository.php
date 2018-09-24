<?php
/**
 * Created by PhpStorm.
 * User: xavierromacastells
 * Date: 4/8/18
 * Time: 17:37
 */

namespace App\model\implementation;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use PDO;
use App\model\Plat;
use App\model\PlatRepository;

class DoctrinePlatRepository implements PlatRepository
{


    private $database;


    public function __construct(Connection $database)
    {
        $this->database = $database;
    }


    public function save_dish(Plat $plat)
    {

        $sql = "INSERT INTO dish(alias, cost_price, benefits, net_price, course_pos, tag)
                VALUES (:alias, :cost_price, :benefits, :net_price, :course_pos, :tag)";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("alias", $plat->get_alias(), 'string');
        $stmt->bindValue("cost_price", $plat->get_cost_price(), 'string');
        $stmt->bindValue("benefits", $plat->get_benefits(), 'string');
        $stmt->bindValue("net_price", $plat->get_net_price(), 'string');
        $stmt->bindValue("course_pos", $plat->get_course_pos(), 'integer');
        $stmt->bindValue("tag", $plat->get_tag(), 'string');
        $stmt->execute();

        $sql = "SELECT LAST_INSERT_ID();";
        $stmt = $this->database->prepare($sql);
        $stmt->execute();

        $id = $stmt->fetchColumn(0);
        $allergens = $plat->get_allergens();

        foreach ($allergens as $allergen) {
            if (is_null($allergen))
                continue;
            $sql = "INSERT INTO dish_allergen(id_dish, id_allergen)
            VALUES (:id_dish, :id_allergen)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id_dish", $id, 'integer');
            $stmt->bindValue("id_allergen", $allergen, 'integer');
            $stmt->execute();

        }


        $languages = $plat->get_languages();

        foreach ($languages as $language) {
            if (is_null($language))
                continue;
            $sql = "INSERT INTO dish_language(id_dish, id_language, dish_name, dish_description)
                VALUES (:id_dish, :id_language, :dish_name, :dish_description)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id_dish", (int)$id, 'integer');
            $stmt->bindValue("id_language", $language['id_language'], 'integer');
            $stmt->bindValue("dish_name", $language['dish_name'], 'string');
            $stmt->bindValue("dish_description", $language['dish_description'], 'string');
            $stmt->execute();

        }




    }

    public function update_dish(Plat $plat)
    {

    }

    public function get_dishes()
    {
        $sql = "SELECT * FROM dish";
        $stmt = $this->database->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $dishes[0] = null;
        $i = 0;
        foreach ($results as $result) {

            $sql = "SELECT id_allergen FROM dish_allergen WHERE id_dish = :id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id", (int)$result['id_dish'], 'integer');
            $stmt->execute();
            $allergens = $stmt->fetchAll();

            $sql = "SELECT * FROM dish_language WHERE id_dish = :id;";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id", (int)$result['id_dish'], 'integer');
            $stmt->execute();
            $languages = $stmt->fetchAll();

            $dishes[$i++] = new Plat($result['id_dish'], $result['alias'], $languages, $result['course_pos'], $allergens, $result['tag'], $result['cost_price'], $result['net_price']);
        }
        return $dishes;

    }

    public function get_dishes_with_option($postion)
    {
        $sql = "SELECT * FROM dish WHERE course_pos = :pos";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("pos",$postion, 'integer');
        $stmt->execute();
        $results = $stmt->fetchAll();

        $dishes[0] = null;
        $i = 0;
        foreach ($results as $result) {

            $sql = "SELECT id_allergen FROM dish_allergen WHERE id_dish = :id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id", (int)$result['id_dish'], 'integer');
            $stmt->execute();
            $allergens = $stmt->fetchAll();

            $sql = "SELECT * FROM dish_language WHERE id_dish = :id;";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue("id", (int)$result['id_dish'], 'integer');
            $stmt->execute();
            $languages = $stmt->fetchAll();

            $dishes[$i++] = new Plat($result['id_dish'], $result['alias'], $languages, $result['course_pos'], $allergens, $result['tag'], $result['cost_price'], $result['net_price']);
        }
        return $dishes;

    }

    public function get_dish($id)
    {
        $sql = "SELECT * FROM dish WHERE id_dish = :id";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("id", (int)$id, 'integer');
        $stmt->execute();
        $result = $stmt->fetch();

        $sql = "SELECT id_allergen FROM dish_allergen WHERE id_dish = :id;";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("id", (int)$id, 'integer');
        $stmt->execute();
        $allergens = $stmt->fetchAll();

        $sql = "SELECT * FROM dish_language WHERE id_dish = :id;";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("id", (int)$id, 'integer');
        $stmt->execute();
        $languages = $stmt->fetchAll();


        $dish = new Plat($result['id_dish'], $result['alias'], $languages, $result['course_pos'], $allergens, $result['tag'], $result['cost_price'], $result['net_price']);

        return $dish;

    }
}