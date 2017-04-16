<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/15/2017
 * Time: 12:17 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

use Closure;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class SaleResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $fonda = $request->route()->fonda;
        $saleId = $request->route()->sale;

        $sale =  $fonda->sales()->where('id', '=', $saleId)->first();
        if ($sale == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40413));

        $request->route()->setParameter('fonda_sale', $sale);
        return $next($request);
    }
}