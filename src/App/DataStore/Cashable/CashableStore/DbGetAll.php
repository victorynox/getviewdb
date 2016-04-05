<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.04.16
 * Time: 10:53
 */

namespace App\DataStore\Cashable\CashableStore;


use App\DataStore\Cashable\CashableStores\GetAllInterface;
use zaboy\res\DataStore\DbTable;

class DbGetAll extends DbTable implements GetAllInterface
{

    /**
     * return array or iterator
     * @return array
     */
    public function getAll()
    {
        return $this->getIterator();
    }
}