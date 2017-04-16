<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/16/2017
 * Time: 10:33 AM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

require_once __DIR__.'/../../../Responses/_loader.php';

use Closure;
use Illuminate\Support\Facades\Input;
use Responses\ResponseJsonBadRequest;

class CommentResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $commentId = $request->route()->comment;
        $user = $request->route()->user;
        $comment = $user->comments()->where('id', '=',$commentId)->first();
        if ($comment == null)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40426));
        $request->route()->setParameter('comment', $comment);
        return $next($request);
    }
}