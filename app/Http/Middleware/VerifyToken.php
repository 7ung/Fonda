<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 4:17 PM
 */

namespace App\Http\Middleware;


use App\Model\AccessToken;
use Closure;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Common/_loader.php';

class VerifyToken
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $token = \Request::input('token');

        if (empty($token))
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40300));

        $token = \Common\putHashPrefix($token);
        $accessToken = AccessToken::where('access_token','=', $token)->first();
        if ($accessToken == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40300));

        $user = $accessToken->user;
        if ($user == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40404));

        $request->route()->setParameter('user', $user);
        return $next($request);

    }
}