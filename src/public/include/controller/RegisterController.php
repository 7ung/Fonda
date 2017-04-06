<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 10:22 AM
 */

namespace fonda\controller;

use common\SimpleMailSender;
use exception\MailSenderException;
use exception\MySqlExecuteFailException;
use model\VerifyMember;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonData;
use responses\ResponseJsonError;
use model\Member;
use entities\User;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'Controller.php';

class RegisterController extends Controller
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

        try
        {
            // assert parameters not null
            $this->assertNotNullParams($username, 'User name must not empty');
            $this->assertNotNullParams($password, 'Password must not empty');
            $this->assertNotNullParams($email, 'Email must not empty');

            $member = new Member();

            //
            if ($member->isExistsByUsername($username) == true)
            {
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username exists', 40901),
                    $response, $request, 409);
            }
            else if ($member->isExistsByEmail($email) == true)
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
                $member->createUser($username, $password, $email);

                $user = $member->findUserByUsername($username);
                if ($user == null)
                    throw new MySqlExecuteFailException('Cannot create user');

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

                try {
                    $mailSender->sendEmail($user->getEmail(),
                        mail_template['verify_code_required'][MAIL_SUBJECT],
                        $body);
                }
                catch (\Exception $e){
                    throw new MailSenderException($e->getMessage(), 500);
                }

                /**
                 * Apply Response
                 */
                $response = ResponseBuilder::build(
                    $verifyInfo, $response, $request, 201);
            }
        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, 500);
        }

        return $response;
    }

}