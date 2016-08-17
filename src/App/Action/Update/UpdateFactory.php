<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 14:47
 */

namespace App\Action\Update;


use Interop\Container\ContainerInterface;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $updateAnalitLazy = function(Request $request, Response $response, callable $next = null) use ($container){
            $resourceName = $request->getAttribute('ResourceName');
            $updateAnalitFactory = new UpdateAnalitFactory();
            $updateAnalitAction = $updateAnalitFactory($container, $resourceName);
            return $updateAnalitAction($request, $response, $next);
        };
        return $updateAnalitLazy;
    }
}