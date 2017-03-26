<?php
namespace fonda\controller;


/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 9:20 PM
 */
use common\SimpleMailSender;
use exception\MailSenderException;
use exception\MySqlExecuteFailException;
use fonda\controller\Controller;
use model\Member;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonData;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'Controller.php';

class ResendPasswordController extends Controller
{

    function getMethod()
    {
        return [GET];
    }

    function getUrl()
    {
        return '/resend_password';
    }

    function exec(Request $request, Response $response)
    {
        $username = $request->getParams()['username'];
        $email = $request->getParams()['email'];
        try{
            $this->assertNotNullParams($username, 'Username must not empty');
            $this->assertNotNullParams($email, 'Email must not empty');

            $member = new Member($username, '', $email);
            /* Check if username exists*/
            if ($member->checkExistsUsername() == false)
            {
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Username not found', 40401),
                    $response, $request, 404);
                return $response;
            }

            /* Check if email exists*/
//            if  ($member->checkExistsEmail() == false)
//            {
//                $response = ResponseBuilder::build(
//                    new ResponseJsonBadRequest('Wrong email', 40402),
//                    $response, $request, 404);
//                return $response;
//            }

            $newPassword = \common\randString(12);

            /* Update new Password */
            if ($member->updatePassword($newPassword) === 0){
               //throw new MySqlExecuteFailException('Some thing wrong', 500);
                $response = ResponseBuilder::build(
                    new ResponseJsonBadRequest('Wrong email', 40402),
                    $response, $request, 404);
                return $response;
            }

            /* Send password to user via email */
            $mailSender = new SimpleMailSender();
            $body = mail_template['resend_password'][MAIL_BODY];
            $body = str_replace('{?}', $newPassword, $body);
            try {
                $mailSender->sendEmail($email,
                    mail_template['resend_password'][MAIL_SUBJECT],
                    $body);
            }
            catch (\Exception $e){
                throw new MailSenderException($e->getMessage(), 500);
            }
            $response = ResponseBuilder::build(new ResponseJsonData(), $response, $request, 200);

        }
        catch(ResponseJsonError $jsonError)
        {
            $response = ResponseBuilder::build($jsonError, $response, $request, $jsonError->getCode());
        }

        return $response;
    }
}