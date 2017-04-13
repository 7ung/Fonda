<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 9:45 PM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

use App\Model\Image;
use Closure;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../../Responses/_loader.php';

class ImageResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $imageId = $request->route()->image_id;
        $image = Image::find($imageId);
        if ($image == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40406));

        if ($image->user_id != $request->route()->user->id)
            return ResponseJsonBadRequest::responseBadRequest(40906);

        $request->route()->setParameter('image', $image);
        return $next($request);

    }


}