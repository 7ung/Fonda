<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/21/2017
 * Time: 9:51 AM
 */

namespace fonda\controller;

use model\VerifyMember;
use responses\ResponseBuilder;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'Controller.php';

class VerifyAccountController extends Controller
{

    function getMethod()
    {
        return [POST];
    }

    function getUrl()
    {
        return '/verify_account';
    }

    function exec(Request $request, Response $response)
    {
        $userId = $request->getParsedBody()['user_id'];
        $code = $request->getParsedBody()['code'];

        try
        {
            $this->assertNotNullParams($userId, 'User id must not empty');
            $this->assertNotNullParams($code, 'Verify code must not empty');

            $verifyMember = new VerifyMember($userId, $code);

            $rs = $verifyMember->verify();
            $status = 0;
            if ($rs == 0)
                $status = 200;
            else
                $status = 202;
            $verifyStatus = $verifyMember->getVerifyStatusByUserId($userId);

            $response = ResponseBuilder::build(
                $verifyStatus, $response, $request, $status);
        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, $jsonError->getCode());
        }

        return $response;
    }

}