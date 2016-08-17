<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 07.04.16
 * Time: 10:19
 */

namespace App\Action;


use Interop\Container\ContainerInterface;

class UpdateAnalitProductsByBrandCategoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        if($container->has('update_analit_products_by_brand_category')){
            $cache = $container->get('update_analit_products_by_brand_category');
        }else{
            throw new \Exception("Cant get update db");
        }

        return new UpdateAnalitProductsByBrandCategoryAction($cache);

    }
}