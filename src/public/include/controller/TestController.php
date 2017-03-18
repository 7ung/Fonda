<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 7:56 PM
 */

namespace fonda\controller;


use function common\quick_hashing;
use function common\verify_quick_hash;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../common/hashing.php';

/**
 * Class TestController: Test every thing here
 * @package fonda\controller
 */
class TestController implements Controller
{

    function getMethod()
    {
        return [GET];
    }

    function getUrl()
    {
        return '/test';
    }

    function exec(Request $request, Response $response)
    {
        $_1 = '';
        $_2 = null;
        $_3 = 'haha';
        var_dump($_1 == null); echo '<br/>';
        var_dump($_2 == null); echo '<br/>';
        var_dump($_3 == null); echo '<br/>';

    }

}