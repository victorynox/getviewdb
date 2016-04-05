<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.04.16
 * Time: 17:38
 */

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeAction
{
    private $renderer;
    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request, Response $response, callable $next){
        //return new JsonResponse(['status' => 'done']);
        return new HtmlResponse($this->renderer->render('app::home-page'));
    }
}