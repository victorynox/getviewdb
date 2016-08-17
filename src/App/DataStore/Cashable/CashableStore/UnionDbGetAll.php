<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 17:38
 */

namespace App\DataStore\Cashable\CashableStore;


use App\DataStore\Cashable\CashableStores\GetAllInterface;
use Xiag\Rql\Parser\Node\Query\ScalarOperator\GtNode;
use Xiag\Rql\Parser\Node\SelectNode;
use Xiag\Rql\Parser\Query;
use zaboy\res\DataStore\DbTable;
use Zend\Db\Adapter\Adapter;

class UnionDbGetAll implements GetAllInterface
{

    /** @var  Adapter */
    protected $adapter;

    /**
     * return array or iterator
     * @return array
     */
    public function getAll()
    {
        $this->query(new Query(new GtNode('id', 0)));
    }

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function query(Query $query){
        
    }

}