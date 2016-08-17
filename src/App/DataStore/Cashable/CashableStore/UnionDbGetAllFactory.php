<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 18:33
 */

namespace App\DataStore\Cashable\CashableStore;


use Interop\Container\ContainerInterface;
use zaboy\res\DataStores\DataStoresException;
use zaboy\res\DataStores\Factory\DataStoresAbstractFactoryAbstract;

class UnionDbGetAllFactory extends DataStoresAbstractFactoryAbstract
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        
        $serviceConfig = $config['dataStore'][$requestedName];

      /*  $dbServiceNames = isset($serviceConfig['dbAdapters']) ? $serviceConfig['dbAdapters'] : ['db'];
        $db = [];
        foreach ($dbServiceNames as $dbServiceName){
            $db[] = $container->has($dbServiceName) ? $container->get($dbServiceName) : null;
        }*/
        $dbServiceName = isset($serviceConfig['dbAdapter']) ? $serviceConfig['dbAdapter'] : 'db';
        $db = $container->has($dbServiceName) ? $container->get($dbServiceName) : null;
        $class = isset($serviceConfig['class']) ? $serviceConfig['class'] : null;
        if(!$db){
            throw new DataStoresException(
                'Can\'t create UnionDbGetAll'
            );
        }
        return new $class($db);
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');
        if (!isset($config['dataStore'][$requestedName]['class'])) {
            return false;
        }
        $requestedClassName = $config['dataStore'][$requestedName]['class'];
        return is_a($requestedClassName, 'App\DataStore\Cashable\CashableStore\UnionDbGetAll', true);
    }
}