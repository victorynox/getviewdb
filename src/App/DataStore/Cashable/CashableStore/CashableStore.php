<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.04.16
 * Time: 10:03
 */

namespace App\DataStore\Cashable\CashableStore;


use App\DataStore\Cashable\CashableStores\CashableStoreAbstract;
use App\DataStore\Cashable\CashableStores\GetAllInterface;
use App\DataStore\Cashable\CashableStores\GetByPartsInterface;
use Traversable;
use Xiag\Rql\Parser\Node\LimitNode;
use Xiag\Rql\Parser\Node\Query\ScalarOperator\GtNode;
use Xiag\Rql\Parser\Node\SelectNode;
use Xiag\Rql\Parser\Query;
use zaboy\res\DataStores\DataStoresInterface;

class CashableStore extends CashableStoreAbstract
{
    public function refresh($limit = null)
    {
        if (method_exists($this->getData, "query")) {

            $idLabel = $this->cashStore->getIdentifier();

            $query = new Query();

            $size = (int)$this->cashStore->count();

            if($size !== 0){
                $query->setLimit(new LimitNode(1, $size - 1));
                $query->setSelect(new SelectNode([$idLabel]));
                $id = $this->cashStore->query($query);
                $id = $id[0]['id'];
            }else{
                $id = 0;
            }

            $query = new Query();
            $query->setLimit(new LimitNode($limit));
            $query->setQuery(new GtNode($idLabel, $id));

            $data = $this->getData->query($query);
        } else {
            $this->cashStore->deleteAll();
            $data = $this->getData->getAll();
        }

        if ($data instanceof Traversable or is_array($data)) {
            foreach ($data as $item) {
                $this->cashStore->create($item, true);
            }
        } else {
            throw new \Exception("Not return refreshed all");
        }
    }

}