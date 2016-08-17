<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 13:55
 */

namespace App\DataStore\Cashable\CashableStore;


use App\DataStore\Cashable\CashableStores\GetAllInterface;
use Xiag\Rql\Parser\Node\Query\LogicOperator\AndNode;
use Xiag\Rql\Parser\Query;
use Zend\Db\Adapter\Adapter;

class JournalUnionDbGetAll extends UnionDbGetAll
{

    /*
     * Select * from `journal`  where `category` = "publish exceed the amount limits" and `id` > 0 Limit 1;
     * Select * from `journal_data`  where `journal_id` = 0;
     */
    public function query(Query $query)
    {
        $limit = $query->getLimit()->getLimit();
        /** @var AndNode $andNode */
        $andNode = $query->getQuery();
        $querys = $andNode->getQueries();
        $id = $querys[0]->getValue();
        $category = $querys[1]->getValue();
        

        $data = [];

        if ($limit) {
            $journalList = $this->adapter->query("Select * from `journal`  where `category` = '" . $category . "' and `id` > " . $id . " LIMIT " . $limit . " ;", Adapter::QUERY_MODE_EXECUTE)->toArray();
        } else {
            $journalList = $this->adapter->query("Select * from `journal`  where `category` = '" . $category . "' and `id` > " . $id . ";", Adapter::QUERY_MODE_EXECUTE)->toArray();
        }


        foreach ($journalList as $journalItem) {
            $temp = [];
            foreach ($journalItem as $key => $value) {
                if($key !== 'category'){
                    $temp[$key] = $value;
                }
            }
            $journalData = $this->adapter->query("Select * from `journal_data`  where `journal_id` =" . $journalItem['id'] . ";", Adapter::QUERY_MODE_EXECUTE)->toArray();
            $temp['data'] = $journalData[0]['data'];
            $data[] = $temp;
        }

        return $data;
    }
}