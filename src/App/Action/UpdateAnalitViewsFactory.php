<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 13:00
 */

namespace App\Action;


use Interop\Container\ContainerInterface;

class UpdateAnalitViewsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if($container->has('update_analit_views')){
            $cache = $container->get('update_analit_views');
        }else{
            throw new \Exception("Cant get update db");
        }
        return new UpdateAnalitViewsAction($cache);

    }
}