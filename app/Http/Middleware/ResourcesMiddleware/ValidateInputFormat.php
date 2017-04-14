<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/14/2017
 * Time: 11:17 AM
 */

namespace App\Http\Middleware\ResourcesMiddleware;

use App\Model\FondaGroup;
use App\Model\Location;
use Closure;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;
use Symfony\Component\Console\Tests\Input\InputTest;

require_once __DIR__.'/../../../Responses/_loader.php';

class ValidateInputFormat
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        static $scaleValue = [1, 2, 3 ];

        /**
         * group_id
         */
        $group_id = Input::get('group_id');
        if (empty($group_id) == false && FondaGroup::find($group_id) == false)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40411));

        /**
         * scale
         */
        $scale = Input::get('scale');
        if (empty($scale) == false && in_array($scale, $scaleValue) == false)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40013));


        /**
         * open_time & close_time
         */

        $openTimeString = Input::get('open_time');
        $open_time = strtotime($openTimeString);

        $closeTimeString = Input::get('close_time');
        $close_time = strtotime($closeTimeString);
        // openTimeStrong != null vì khôgn require open_time
        if ($openTimeString != null && $open_time == false)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40014));
        if ($closeTimeString != null && $close_time == false)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40014));
        if ($close_time < $open_time)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40914));

        /**
         * active
         */

        $active = Input::get('active');
        if ($active != null && ($active != 0 && $active != 1))
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40017));


        /**
         * location
         */

        if (empty(Input::get('location')) == false)
        {
            $locationArray = explode(',',Input::get('location'));
            if (count($locationArray) !== 2 && count($locationArray) !== 3 )
                return response()->json(ResponseJsonBadRequest::responseBadRequest(40015));

        }

        /**
         * open_day
         */
        $openDay = Input::get('open_day');
        if (empty($openDay) != false && $openDay >= 128)
            return response()->json(ResponseJsonBadRequest::responseBadRequest(40016));

        return $next($request);


    }
}