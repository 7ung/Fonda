<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/14/2017
 * Time: 8:29 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

use App\Model\ImageFonda;
use Closure;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class FondaImageResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $fondaImageId = $request->route()->image;
        $fonda = $request->route()->fonda;

        $fondaImage = ImageFonda::find($fondaImageId);
        if ($fondaImage == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40412));

        if ($fondaImage->fonda_id != $fonda->id)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40912));

        $fondaImage = $fonda->images()->where('image_id', '=',$fondaImageId)->first();

        $request->route()->setParameter('fonda_image', $fondaImage);
        return $next($request);
    }
}