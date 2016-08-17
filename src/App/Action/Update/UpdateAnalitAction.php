<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.04.16
 * Time: 14:54
 */

namespace App\Action\Update;

use App\DataStore\Cashable\CashableStore\CashableStore;
use App\DataStore\Cashable\CashableStores\CashableStoreAbstract;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

class UpdateAnalitAction
{

    private $options;
    private $cacheable;

    public function __construct(CashableStoreAbstract $cacheable, $options)
    {
        $this->cacheable = $cacheable;
        $this->options = $options;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {

        try {
            $countOld = (int)$this->cacheable->getCashStore()->count();
            if (isset($this->options['limit'])) {
                if (isset($this->options['category'])) {
                    $this->cacheable->refresh($this->options['limit'], $this->options['category']);
                } else {
                    $this->cacheable->refresh($this->options['limit']);
                }
            } else {
                if (isset($this->options['category'])) {
                    $this->cacheable->refresh($this->options['category']);
                } else {
                    $this->cacheable->refresh();
                }
            }

            $time = (new \DateTime())->format("H:i:s:u");
            $CountNew = (int)$this->cacheable->getCashStore()->count();
            $report = [
                'status' => 'done',
                'oldSize' => $countOld,
                'newSize' => $CountNew,
                'add element' => $CountNew - $countOld,
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