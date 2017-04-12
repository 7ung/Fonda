<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 12:14 AM
 */

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\VerifyStatus;
use Common\SimpleMailSender;
use Exceptions\MailSenderException;
use Exceptions\MySqlExecuteFailException;
use Request;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../../Exceptions/_loader.php';
require_once __DIR__ . '/../../../Responses/_loader.php';

class RegisterController extends Controller
{
    public function action()
    {
        /**
         * Get params from input
         */
        $username = Request::input('username');
        $password = Request::input('password');
        $email = Request::input('email');

        /**
         * Check required params
         */
        if (empty($username))
            return ResponseJsonBadRequest::responseBadRequest(40001);
        if (empty($email))
            return ResponseJsonBadRequest::responseBadRequest(40002);
        if (empty($password))
            return ResponseJsonBadRequest::responseBadRequest(40003);

        /**
         * Validate data
         */
        if (User::isExistsUsername($username))
            return ResponseJsonBadRequest::responseBadRequest(40901);
        if (User::isExistsEmail($email))
            return ResponseJsonBadRequest::responseBadRequest(40902);

        /**
         * Create user
         */
        $rs = User::createUser($username, $password, $email);
        if ($rs == false)
            throw new MySqlExecuteFailException('Can not create user');

        $user = User::findByUsername($username);
//        $rs = VerifyStatus::createByUserId($user->id);

//        if ($rs == false)
//            throw new MySqlExecuteFailException('Can not create verify status');

        /**
         * Create Verify Status
         */
        $verifyStatus = VerifyStatus::where('user_id', '=', $user->id)->first();

        /**
         * Send mail
         */
        VerifyStatus::sendMail($user->email, $verifyStatus->code);

        return ResponseBuilder::build($verifyStatus, 200);

    }
}