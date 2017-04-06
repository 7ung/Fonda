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


    /**
     * Params: username, password
     * Step 1: Find user by username => user. Assert user not null
     * Step 2: Check if user has verified: Find verify status by user.id => verify_status.
     *          Assert verify_status not null and verify_status.status = 3
     * Step 3: Check if password is correct
     * Step 4: Find access token by user.id => token.
     *          IF token is null
 *              THEN create new token and return.
     *          ELSE return token.
     * @param Request $request
     * @param Response $response
     * @return Response|static
     */
    function exec(Request $request, Response $response)
    {
        $username = $request->getParsedBody()['username'];
        $password = $request->getParsedBody()['password'];
        try {
            $this->assertNotNullParams($username, 'User name must not empty');
            $this->assertNotNullParams($password, 'Password must not empty');

            /* Get user info */
            $member = new Member();
            $user = $member->findUserByUsername($username);

            if ($user == null) {
                /* User name incorrect */
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username or password wrong', 40101),
                    $response, $request, 401
                );
                return $response;
            }

            /* User name correct */
            /* Check status account, if account has not active, not allow login*/
            $verifyMember = new VerifyMember($user->id);
            $verifyStatus = $verifyMember->findVerifyStatusByUserId($user->id);

            if ($verifyStatus->status != 3){
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Account has not active', 40102),
                    $response, $request, 401
                );
                return $response;
            }

            /* Account is good status */
            /* Check password, if wrong password, not allow login.*/
            $correct = \common\verify_string($password, $user->temporaryPassword);
            if ($correct == false){
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username or password wrong', 40101),
                    $response, $request, 401
                );
                return $response;
            }

            $accessToken = new AccessToken();

            /*Kiểm tra có tồn tại token chưa. nếu có thì trả về token. nếu chưa thì tạo token*/
            $token = $accessToken->findTokenByUserId($user->id);
            if ($token == null){
                // chưa tồn tại token
                $accessToken->createToken($user->id);
                $token = $accessToken->findTokenByUserId($user->id);
            }

            return ($response = ResponseBuilder::build($token, $response, $request, 200));

        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, 400);
        }

        return $response;
    }
}