<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/15/2017
 * Time: 2:30 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

use Closure;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class FondaUtilityResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $utilityId = $request->route()->utility;
        $fonda = $request->route()->fonda;
        $utility = $fonda->utilities()->where('utility_id','=',$utilityId)->first();
        if ($utility == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40415));

        $request->route()->setParameter('fonda_utility', $utility);
        return $next($request);
    }
}