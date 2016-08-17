<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 15:39
 */

namespace App\Action;


use Interop\Container\ContainerInterface;

class UpdateJournalFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if($container->has('update_journal')){
            $cache = $container->get('update_journal');
        }else{
            throw new \Exception("Cant get update db");
        }
        return new UpdateJournalAction($cache);

    }
}