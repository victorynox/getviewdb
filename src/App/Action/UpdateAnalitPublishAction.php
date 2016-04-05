<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 12:56
 */

namespace App\Action;

use App\DataStore\Cashable\CashableStore\CashableStore;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

class UpdateAnalitPublishAction
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
            $this->cacheable->refresh(50000);
            $CountNew = (int) $this->cacheable->getCashStore()->count();
            $report = [
                'status' => 'done',
                'oldSize' => $countOld,
                'newSize' => $CountNew,
                'add element' => $CountNew-$countOld
            ];
        } catch (\Exception $e) {
            $report = [
                'status' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
        return new JsonResponse($report);

    }
}