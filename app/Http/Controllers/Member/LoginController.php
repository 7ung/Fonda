<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Model\AccessToken;
use App\Model\User;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../../Exceptions/_loader.php';
require_once __DIR__ . '/../../../Responses/_loader.php';
require_once __DIR__ . '/../../../Common/_loader.php';

class LoginController  extends Controller
{
    /**
     * Đăng nhập
     * Method: POST
     * URL: /login
     * param:
     *          username
     *          password
     *
     * @return array
     */
    public function action()
    {
        /**
         *
         */
        $username = \Request::input('username');
        $password = \Request::input('password');

        /**
         *
         */
        if (empty($username))
            return ResponseJsonBadRequest::responseBadRequest(40001);
        if (empty($password))
            return ResponseJsonBadRequest::responseBadRequest(40003);

        /**
         *
         */
        $user = User::findByUsername($username);
        if ($user == null)
            return ResponseJsonBadRequest::responseBadRequest( 40101);

        /* Check status account, if account has not active, not allow login*/
        if ($user->verify_status->isValidUser() == false)
            return ResponseJsonBadRequest::responseBadRequest( 40102);

        $correct = \common\verify_string($password, $user->password);
        if ($correct == false)
            return ResponseJsonBadRequest::responseBadRequest(40101);

        $token = AccessToken::getTokenByUserId($user->id);
        return ResponseBuilder::build($token);

    }

    /**
     * Đăng xuất
     * Method: POST
     * URL: /logout
     * query:
     *          token
     *  Ví du [root]/logout?token=dumm
     *  Chú ý. Logout thành công chỉ trả về mã code 200. không có dữ liệu trả về.
     *          Chỉ sử dụng api logout khi người dùng muốn "Logout tất cả thiết bị"
     *              nếu không thì chỉ cần xoá token trên local
     * @param \Request $request
     * @param User $user
     * @return array
     */
    public function logout(\Request $request, User $user)
    {
        $user->access_token->delete();
        return ResponseBuilder::build(null,200, 'Logout successfully');
    }

}