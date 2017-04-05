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
use responses\ResponseJsonBadRequest;
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

            /* Kiêm tra thông tin verify */

            $verifyStatus = $verifyMember->findVerifyStatusByUserId($userId);
            if ($verifyStatus == null){
                // Sai user id
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username not found', 40401),
                    $response, $request, 404);
                return $response;
            }

            if ($verifyStatus->expired < $_SERVER['REQUEST_TIME']){
                $verifyStatus->status = 2;
                $verifyMember->save($verifyStatus);
            }

            if ($verifyStatus->status == 2 || $verifyStatus->status == 3){
                $response = ResponseBuilder::build(
                    $verifyStatus, $response, $request, 202);
                return $response;
            }

            if ($verifyStatus->status == 1 && $verifyStatus->code == $code
                && $verifyStatus->expired > $_SERVER['REQUEST_TIME'] && $verifyStatus->triedTime < 3){
                $verifyStatus->status = 3;
                $verifyMember->save($verifyStatus);
                $response = ResponseBuilder::build(
                    $verifyStatus, $response, $request, 200);
                return $response;
            }


            // hết hạn hoặc quá 3 lần
            $verifyStatus->triedTime += 1;
            if ($verifyStatus->triedTime >= 3)
                $verifyStatus->status = 2;
            $verifyMember->save($verifyStatus);
            $response = ResponseBuilder::build(
                $verifyStatus, $response, $request, 202);
            return $response;



//            if ($rs == -1){
//                /* Verify fail, username not exists */
//                $response = ResponseBuilder::build(
//                    new ResponseJsonBadRequest('Username not found', 40401),
//                    $response, $request, 404);
//            }
//            else {
//                if ($rs == 0)
//                    $status = 200;
//                else
//                    $status = 202;
//                $verifyStatus = $verifyMember->findVerifyStatusByUserId($userId);
//
//                $response = ResponseBuilder::build(
//                    $verifyStatus, $response, $request, $status);
//            }
        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, $jsonError->getCode());
        }

        return $response;
    }

}