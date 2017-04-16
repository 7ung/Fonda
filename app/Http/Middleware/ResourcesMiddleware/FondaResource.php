<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/14/2017
 * Time: 8:51 AM
 */

namespace App\Http\Middleware\ResourcesMiddleware;


use App\Model\Fonda;
use Closure;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class FondaResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $fondaId = $request->route()->id;
        $fonda = Fonda::find($fondaId);
        if ($fonda == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40410));

        $user = $request->route()->user;
        if ($user != null && $user->id != $fonda->user->id)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40311));

        $request->route()->setParameter('fonda', $fonda);
        return $next($request);
    }
}