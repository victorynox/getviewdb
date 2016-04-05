<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05.04.16
 * Time: 14:40
 */

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Zend\Diactoros\Response\JsonResponse;

class TestGetFromBigDBAction
{
    public function __invoke(Request $request, Response $response, callable $next){
        $db = [
            'host' => 'localhost',
            'user' => 'mototouc_adm',
            'password' => 'tKd649Ot',
            'database' => 'mototouc_saasebay',
        ];

        /*if(PHP_VERSION > 5.4){
            $connect = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
            mysqli_query($connect, 'SELECT * FROM');
        }else{

        }*/
        $dbcnx = @mysql_connect($db['host'], $db['user'], $db['password']);
        if($dbcnx){
            if(@mysql_select_db($db['database'], $dbcnx)){
                $ath = mysql_query("SELECT * FROM analit_products_by_brand_category LIMIT 4;");
                if($ath){
                    $item = mysql_fetch_array($ath);
                }else{
                    $item = [
                        'status' => 'error',
                        'messages' => 'on query'
                    ];
                }
            }else{
                $item = [
                    'status' => 'error',
                    'messages' => 'on db select'
                ];
            }
        }else{
            $item = [
                'status' => 'error',
                'messages' => 'on db connect'
            ];
        }
        
        return new JsonResponse($item);
    }
}