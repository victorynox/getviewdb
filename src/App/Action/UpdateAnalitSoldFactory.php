<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 12:58
 */

namespace App\Action;


use Interop\Container\ContainerInterface;

class UpdateAnalitSoldFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if($container->has('update_analit_sold')){
            $cache = $container->get('update_analit_sold');
        }else{
            throw new \Exception("Cant get update db");
        }
        return new UpdateAnalitSoldAction($cache);

    }
}