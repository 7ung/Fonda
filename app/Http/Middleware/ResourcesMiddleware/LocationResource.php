<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 10:23 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;


use App\Model\Location;
use Closure;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class LocationResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {

        $locationId = $request->route()->location_id;
        $location = Location::find($locationId);
        if ($location == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40405));

        if ($request->route()->user->id != $location->profile->user_id)
            return ResponseJsonBadRequest::responseBadRequest(40905);

        $request->route()->setParameter('location', $location);
        return $next($request);

    }
}