<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 2:18 PM
 */

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Model\VerifyStatus;
use Exceptions\MySqlExecuteFailException;
use Request;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../../Exceptions/_loader.php';
require_once __DIR__ . '/../../../Responses/_loader.php';

class VerifyStatusController extends Controller
{

    public function action($userId)
    {
        /**
         * Get params from input
         */
        $code = Request::input('code');

        if (empty($code))
            return ResponseJsonBadRequest::responseBadRequest(40004);

        $verifyStatus = VerifyStatus::where('user_id', '=', $userId)->first();

        if ($verifyStatus == null)
            return ResponseJsonBadRequest::responseBadRequest(40404);

        if ($verifyStatus->expired < $_SERVER['REQUEST_TIME']) {
            $verifyStatus->status = 2;
            $verifyStatus->save();
        }

        if ($verifyStatus->status == 2 || $verifyStatus->status == 3) {
            return ResponseBuilder::build(
                $verifyStatus, 202);
        }

        if ($verifyStatus->status == 1 && $verifyStatus->code == $code
            && $verifyStatus->expired > $_SERVER['REQUEST_TIME'] && $verifyStatus->tried_time < 3)
        {
            $verifyStatus->status = 3;
            $verifyStatus->save();
            return ResponseBuilder::build($verifyStatus);
        }

        // hết hạn hoặc quá 3 lần
        $verifyStatus->tried_time += 1;
        if ($verifyStatus->tried_time >= 3)
            $verifyStatus->status = 2;
        $verifyStatus->save();
        return ResponseBuilder::build($verifyStatus, 202);

    }

    /**
     *
     * Xin lại verify code
     * url: /users/{id}/verify
     * method: GET
     * params: không có
     *
     * @param $userId
     * @return array
     * @throws MySqlExecuteFailException
     */
    public function resend($userId)
    {
        $verifyStatus = VerifyStatus::where('user_id', '=', $userId)->first();

        if ($verifyStatus == null)
            return ResponseJsonBadRequest::responseBadRequest(40404);

        if ($verifyStatus->status == 3)
            return ResponseJsonBadRequest::responseBadRequest(40903);

        $rs = $verifyStatus->generateCode();
        if ($rs == false)
            throw new MySqlExecuteFailException('Can not generate new verify code');

        VerifyStatus::sendMail($verifyStatus->user->email, $verifyStatus->code);
        return ResponseBuilder::build($verifyStatus);
    }
}