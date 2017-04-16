<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/15/2017
 * Time: 6:46 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;


use Closure;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class FondaCulinaryResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $culinaryId = $request->route()->culinary;
        $fonda = $request->route()->fonda;
        $culinary = $fonda->culinaries()->where('culinary_id','=', $culinaryId)->first();
        if ($culinary == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40415));

        $request->route()->setParameter('fonda_culinary', $culinary);
        return $next($request);
    }
}