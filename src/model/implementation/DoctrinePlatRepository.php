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

        $sql = "INSERT INTO Plat(alias, cost_price, benefits, net_price, course_pos, tag)
                VALUES (:alias, :cost_price, :benefits, :net_price, :course_pos, :tag)";
        $stmt = $this->database->prepare($sql);
        $stmt->bindValue("alias", $plat->get_alias(), 'string');
        $stmt->bindValue("cost_price", $plat->get_cost_price(), 'float');
        $stmt->bindValue("benefits", $plat->get_benefits(), 'float');
        $stmt->bindValue("net_price", $plat->get_net_price(), 'float');
        $stmt->bindValue("course_pos", $plat->get_course_pos(), 'integer');
        $stmt->bindValue("tag", $plat->get_tag(), 'string');
        $stmt->execute();
    }

    public function update_dish(Plat $plat)
    {

    }
}