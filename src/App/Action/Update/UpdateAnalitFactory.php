<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 14:53
 */

namespace App\Action\Update;

use Interop\Container\ContainerInterface;

class UpdateAnalitFactory
{
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $config = $container->get("config");
        $requestedName = "update_" . $requestedName;
       
        $serviceConfig = $config['dataStore'][$requestedName];

        $options['limit'] = isset($serviceConfig['limit']) ? $serviceConfig['limit'] : null;
        $options['category'] = isset($serviceConfig['category']) ? $serviceConfig['category'] : null;

        return new UpdateAnalitAction($container->get($requestedName), $options);
    }
}