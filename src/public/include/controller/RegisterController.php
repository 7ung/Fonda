<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 10:22 AM
 */

namespace fonda\controller;

use common\ResponseBuilder;
use interfaces\ResponseJsonBadRequest;
use interfaces\ResponseJsonData;
use interfaces\ResponseJsonError;
use model\Member;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__.'/Controller.php';
require __DIR__ .'/../exception/MySqlExecuteFailException.php';
require __DIR__ . '/../responses/ResponseJsonBadRequest.php';
require __DIR__ . '/../responses/ResponseJsonData.php';
require __DIR__ . '/../responses/ResponseBuilder.php';
require __DIR__.'/../model/Member.php';

class RegisterController implements Controller
{

    function getMethod(){
        return [POST];
    }

    function getUrl() {
        return "/register";
    }

    function exec(Request $request, Response $response)
    {
        $username = $request->getParsedBody()['username'];
        $password = $request->getParsedBody()['password'];
        $email = $request->getParsedBody()['email'];

        $member = new Member($username, $password, $email);

        try
        {
            if ($member->checkExistsUsername() == true)
            {
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username exists', 40901),
                    $response, $request, 409);
            }
            else if ($member->checkExistsEmail() == true)
            {
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('User\'s Email exists', 40902),
                    $response, $request, 409);
            }
            else
            {
                // not exists user. allow to register
                $id = $member->createUser();
                $response = $response = ResponseBuilder::build(
                    new ResponseJsonData(), $response, $request, 201);
            }
        }
        catch(ResponseJsonError $mySqlExecuteException)
        {
            $response = ResponseBuilder::build($mySqlExecuteException, $response, $request, 500);
        }

        return $response;
    }

}