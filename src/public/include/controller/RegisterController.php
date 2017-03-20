<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 10:22 AM
 */

namespace fonda\controller;

use common\SimpleMailSender;
use model\VerifyMember;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonData;
use responses\ResponseJsonError;
use model\Member;
use entities\User;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__.'/Controller.php';
require __DIR__ .'/../exception/MySqlExecuteFailException.php';
require __DIR__ . '/../responses/ResponseJsonBadRequest.php';
require __DIR__ . '/../responses/ResponseJsonData.php';
require __DIR__ . '/../responses/ResponseBuilder.php';
require __DIR__.'/../model/Member.php';
require __DIR__.'/../model/VerifyMember.php';
require __DIR__.'/../common/SimpleMailSender.php';

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

                /**
                 * Create User Account
                 */
                $user = $member->createUser();

                /**
                 * Create Verify Code
                 */
                $verify = new VerifyMember($user->getId());
                $verifyInfo = $verify->createVerifyCode();

                /**
                 * Send mail
                 */
                $mailSender = new SimpleMailSender();
                $body = mail_template['verify_code_required'][MAIL_BODY];
                $body = str_replace('{?}', $verifyInfo->code, $body);
                $mailSender->sendEmail($user->getEmail(),
                    mail_template['verify_code_required'][MAIL_SUBJECT],
                    $body);

                /**
                 * Apply Response
                 */
                $response = $response = ResponseBuilder::build(
                    $verifyInfo, $response, $request, 201);
            }
        }
        catch(ResponseJsonError $mySqlExecuteException)
        {
            $response = ResponseBuilder::build($mySqlExecuteException, $response, $request, 500);
        }

        return $response;
    }

}