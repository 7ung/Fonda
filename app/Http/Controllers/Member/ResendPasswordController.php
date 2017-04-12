<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 3:50 PM
 */

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Model\AccessToken;
use App\Model\User;
use Common\SimpleMailSender;
use Exceptions\MailSenderException;
use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Request;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../../Exceptions/_loader.php';
require_once __DIR__ . '/../../../Responses/_loader.php';

class ResendPasswordController extends Controller
{
    public function action()
    {
        /**
         *
         */
        $username = Input::get('username');
        $email = Input::get('email');

        /**
         *
         */
        if (empty($username))
            return ResponseJsonBadRequest::responseBadRequest(40001);
        if (empty($email))
            return ResponseJsonBadRequest::responseBadRequest(40002);

        /**
         *
         */
        $user = User::findByUsername($username);
        if ($user == null)
            return ResponseJsonBadRequest::responseBadRequest( 40401);

        if ($user->email != $email)
            return ResponseJsonBadRequest::responseBadRequest(40402);

        $newPassword = \common\randString(12);
        $user->password = \common\strong_hashing($newPassword);
        $rs = $user->save();
        if ($rs == false)
            throw new MySqlExecuteFailException('Can not update new password');

        /* Send password to user via email */
        $mailSender = new SimpleMailSender();
        $body = mail_template['resend_password'][MAIL_BODY];
        $body = str_replace('{?}', $newPassword, $body);
        try {
            $mailSender->sendEmail($user->email,
                mail_template['resend_password'][MAIL_SUBJECT],
                $body);
        }
        catch (\Exception $e){
            throw new MailSenderException($e->getMessage(), 500);
        }

        return ResponseBuilder::build($user);
    }

    /**
     * Update password
     * @param Request $request
     * @param User $user
     * @return array
     */
    public function update(Request $request, User $user)
    {
        $password = Request::input('password');
        if (empty($password))
            return ResponseJsonBadRequest::responseBadRequest(40001);

        $rs = $user->changePassword($password);
        $user = User::find($user->id);
        if ($rs == false)
            return ResponseBuilder::build(null, 500, 'Error - Can not update password');
        else
            return ResponseBuilder::build($user, 200, 'Update password success');
    }
}