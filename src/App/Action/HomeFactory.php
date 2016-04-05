<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.04.16
 * Time: 17:41
 */

namespace App\Action;


use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new HomeAction($container->get(TemplateRendererInterface::class));
    }

}