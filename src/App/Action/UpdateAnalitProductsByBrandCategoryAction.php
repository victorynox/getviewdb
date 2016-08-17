<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 07.04.16
 * Time: 10:19
 */

namespace App\Action;

use App\DataStore\Cashable\CashableStore\CashableStore;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

class UpdateAnalitProductsByBrandCategoryAction
{
    private $cacheable;

    public function __construct(CashableStore $cacheable)
    {
        $this->cacheable = $cacheable;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {

        try {
            $countOld = (int) $this->cacheable->getCashStore()->count();
            $this->cacheable->refresh(1);
            $time = (new \DateTime())->format("H:i:s:u");
            $CountNew = (int) $this->cacheable->getCashStore()->count();
            $report = [
                'status' => 'done',
                'oldSize' => $countOld,
                'newSize' => $CountNew,
                'add element' => $CountNew-$countOld,
                'time' => $time
            ];
        } catch (\Exception $e) {
            $report = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];
        }

        return new JsonResponse($report);

    }

}