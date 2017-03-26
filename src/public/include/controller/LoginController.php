<?php

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/25/2017
 * Time: 10:03 AM
 */
namespace fonda\controller;

use exception\InvalidArgumentException;
use fonda\controller\Controller;
use model\AccessToken;
use model\Member;
use model\VerifyMember;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'Controller.php';

class LoginController extends Controller
{

    function getMethod()
    {
        return [POST];
    }

    function getUrl()
    {
        return '/login';
    }

    function exec(Request $request, Response $response)
    {
        $username = $request->getParsedBody()['username'];
        $password = $request->getParsedBody()['password'];
        try {
            $this->assertNotNullParams($username, 'User name must not empty');
            $this->assertNotNullParams($password, 'Password must not empty');

            /* Get basic token info */
            $accessToken = new AccessToken($username, $password);
            $token = $accessToken->getInfo();
            if ($token == null) {
                /* User name incorrect */
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username or password wrong', 40101),
                    $response, $request, 401
                );
                return $response;
            }

            /* User name correct */
            /* Check status account, if account has not active, not allow login*/
            $verifyMember = new VerifyMember($token->user->id);
            $verifyStatus = $verifyMember->getVerifyStatusByUserId($token->user->id);

            if ($verifyStatus->status != 3){
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Account has not active', 40102),
                    $response, $request, 401
                );
                return $response;
            }

            /* Account is good status */
            /* Check password, if wrong password, not allow login.*/
            $correct = \common\verify_string($password, $token->user->temporaryPassword);
            if ($correct == false){
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username or password wrong', 40101),
                    $response, $request, 401
                );
                return $response;
            }

            /* Password is correct */
            /* Create token*/
            $token->id = $accessToken->createToken($token->user->id);

            /* if token created, get token info  */
            if ($token->id == 0)
                throw new InvalidArgumentException('Some unexpected error', 500);
            $accessToken->getToken($token);
            $response = ResponseBuilder::build($token, $response, $request, 200);

        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, 400);
        }

        return $response;
    }
}