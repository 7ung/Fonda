<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 9:45 AM
 */

namespace fonda\controller;

use exception\InvalidArgumentException;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../constant.php';
require_once __DIR__.'/../exception/_loader.php';
require_once __DIR__.'/../responses/_loader.php';
require_once __DIR__.'/../model/_loader.php';
require_once __DIR__.'/../common/_loader.php';

abstract class Controller
{

    abstract function getMethod();
    abstract function getUrl();
    abstract function exec(Request $request, Response $response );

    protected function assertNotNullParams(&$var, $message)
    {
        if ($var == null)
            throw new InvalidArgumentException($message, 400);
    }
}