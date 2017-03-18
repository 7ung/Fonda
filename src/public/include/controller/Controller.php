<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 9:45 AM
 */

namespace fonda\controller;

use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../constant.php';

interface Controller
{

    function exec(Request $request, Response $response );
    function getMethod();
    function getUrl();

}