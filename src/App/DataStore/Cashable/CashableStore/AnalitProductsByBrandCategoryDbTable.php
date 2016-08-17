<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.04.16
 * Time: 12:25
 */

namespace App\DataStore\Cashable\CashableStore;


use zaboy\res\DataStore\DbTable;

class AnalitProductsByBrandCategoryDbTable extends DbTable
{

    public function getIdentifier()
    {
        return 'productid';
    }
}