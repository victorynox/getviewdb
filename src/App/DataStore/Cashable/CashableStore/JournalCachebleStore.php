<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 17:02
 */

namespace App\DataStore\Cashable\CashableStore;


use App\DataStore\Cashable\CashableStores\CashableStoreAbstract;
use Traversable;
use Xiag\Rql\Parser\Node\LimitNode;
use Xiag\Rql\Parser\Node\Query\LogicOperator\AndNode;
use Xiag\Rql\Parser\Node\Query\ScalarOperator\GtNode;
use Xiag\Rql\Parser\Node\SelectNode;
use Xiag\Rql\Parser\Query;

class JournalCachebleStore extends CashableStoreAbstract
{
    public function refresh($limit = null, $category = null)
    {
        if (method_exists($this->getData, "query")) {

            $idLabel = $this->cashStore->getIdentifier();

            $query = new Query();

            $size = (int)$this->cashStore->count();

            if ($size !== 0) {
                $query->setLimit(new LimitNode(1, $size - 1));
                $query->setSelect(new SelectNode([$idLabel]));
                $id = $this->cashStore->query($query);
                $id = $id[0][$idLabel];
            } else {
                $id = 0;
            }

            $query = new Query();
            $query->setLimit(new LimitNode($limit));
            if($category){
                $query->setQuery(new AndNode([new GtNode($idLabel, $id), new GtNode('category', $category)]));
            }else{
                throw new \Exception("Dos'n set category");
            }

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