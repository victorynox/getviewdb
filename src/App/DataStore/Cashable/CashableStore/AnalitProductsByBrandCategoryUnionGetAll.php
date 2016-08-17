<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 14:04
 */

namespace App\DataStore\Cashable\CashableStore;

use Xiag\Rql\Parser\Query;
use Xiag\Rql\Parser\Node\Query\LogicOperator\AndNode;
use Zend\Db\Adapter\Adapter;

class AnalitProductsByBrandCategoryUnionGetAll extends UnionDbGetAll
{

    private function getData($id)
    {
        $data = [];

        $analitPublish = $this->getAnalitPublishID();

        foreach ($analitPublish as $productid) {

            $rockyCatalog = $this->adapter->query("SELECT `productid` , `brand`, `ebaycategory`, `id` FROM `rocky_catalog` WHERE `rocky_catalog`.`productid` = " . $productid['productid'] . ";", Adapter::QUERY_MODE_EXECUTE)->toArray();

            foreach ($rockyCatalog as $rockyItem) {

                $temp = [];
                foreach ($rockyItem as $key => $value) {
                    $temp[$key] = $value;
                }

                $categoryMotors = $this->adapter->query("SELECT `CategoryIDs-Motors`.`NAME` AS `category`, `CategoryIDs-Motors`.`CATEGORY_LEAF_LEVEL_ID` AS `category_path` FROM `CategoryIDs-Motors` WHERE `CategoryIDs-Motors`.`CATEGORY ID` = " . $rockyItem['ebaycategory'] . ";", Adapter::QUERY_MODE_EXECUTE)->toArray();

                foreach ($categoryMotors[0] as $key => $value) {
                    $temp[$key] = $value;
                }
                $data[] = $temp;
                break;
            }
        }

        return $data;
    }

    public function query(Query $query)
    {
        $id = $query->getQuery()->getValue();
        $data = $this->getData($id);

        return $data;
    }

    private function getAnalitPublishID()
    {
        $adapter = new Adapter([
            'driver' => 'Pdo_Mysql',
            'database' => 'mototouc_saascom',
            'username' => 'root',
            'password' => '123qwe321',
            'host' => 'localhost',
            'port' => '3306'
        ]);

        return $adapter->query("SELECT `productid` FROM `publish` GROUP BY `productid` LIMIT 34032,12500;", Adapter::QUERY_MODE_EXECUTE)->toArray();
    }
}