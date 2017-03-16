<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 9:45 AM
 */

namespace fonda\controller;

use Psr\Http\Message\ResponseInterface ;
use Psr\Http\Message\ServerRequestInterface ;

require_once __DIR__.'/../constant.php';

interface Controller
{

    function exec(ServerRequestInterface $request, ResponseInterface $response );
    function getMethod();
    function getUrl();

}