<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 7:22 PM
 */

namespace App\Http\Middleware;


use Closure;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

class VendorUserRole
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        static $roleName = 'Vendor';
        $userRole = $request->route()->user->user_role;
        if ($userRole == null || $userRole->code != $roleName)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40301));
        return $next($request);
    }
}