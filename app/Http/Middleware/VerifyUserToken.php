<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 3:31 PM
 */

namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use Responses\ResponseJsonBadRequest;

/**
 * Class VerifyUserToken
 * Chỉ áp dụng cho url kiểu /user/{id}/some_resource ...
 *  param token
 * method   POST, PUT, DELETE
 * @package App\Http\Middleware
 */
class VerifyUserToken
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->route()->id;
        $token = \Request::input('token');

        if (empty($token))
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40300));

        $user = User::find($userId);
        if ($user == null)
             return response()->json(ResponseJsonBadRequest::responseBadRequest(40404));

        $token = \Common\putHashPrefix($token);
        if ($user->access_token == null || $user->access_token->access_token != $token)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40300));

        $request->route()->setParameter('user', $user);

        return $next($request);
    }
}