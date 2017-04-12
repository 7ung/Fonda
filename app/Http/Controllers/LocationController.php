<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 2:02 PM
 */

namespace App\Http\Controllers;


use App\Model\Location;
use App\Model\User;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../Exceptions/_loader.php';
require_once __DIR__ . '/../../Responses/_loader.php';

class LocationController
{

    private static $paging = 4;

    /**
     * Url          /locations
     * Method       get
     * Query params:
     *              city (non-required)
     *              type ('user', 'fonda', non-required)
     */
    public function index()
    {
        $city = Input::get('city');
        $type = Input::get('type');

        $locations = Location::all();

        if (empty($city) && empty($type))
            return ResponseBuilder::build($locations->toArray());
        // tạm.
    }

    /**
     * Mỗi người dùng có thể có nhiều location.
     *
     * Url:         /users/{id}/location
     * method       get
     * params
     * @param $userId
     * @return array
     */
    public function showByUser($userId)
    {
        $user = User::find($userId);
        $locations = Location::where('profile_id', '=', $user->profile->id)->paginate(self::$paging);
        return ResponseBuilder::build($locations->toArray());
    }

    /**
     * Một cửa hàng có 1 location
     * @param $userId
     * @return array
     */
    public function fondaLocation($userId)
    {
        $user = User::find($userId);
        $locations = Location::where('profile_id', '=', $user->profile->id)->paginate(self::$paging);
        return ResponseBuilder::build($locations->toArray());
    }

    /**
     * Show 1 location theo location id
     * URL      /locations/{id}
     * Method   GET
     * @param $id
     * @return array
     */
    public function show($id)
    {
        return ResponseBuilder::build(Location::find($id));
    }

    /**
     * Tạo một location mới và gắn cho user profile với user id = ?
     * Url          /users/{id}/location
     * Method       POST
     * Param
     *              longitude - required
     *              latitude - required
     *              city - non-required
     *              token - required
     * @param \Request $request
     * @param int $userId: parse from url
     * @param User $user: parse from middleware VerifyUserToken
     * @return array
     */
    public function store(\Request $request, $userId, User $user)
    {
        /**
         *
         */
        $longitude = \Request::input('longitude');
        $latitude = \Request::input('latitude');
        $city = \Request::input('city');

        /**
         *
         */
        if (empty($longitude))
            return ResponseJsonBadRequest::responseBadRequest(40005);

        if (empty($latitude))
            return ResponseJsonBadRequest::responseBadRequest(40006);

        /**
         *
         */
        $location = new Location();
        $location->longitude = $longitude;
        $location->latitude = $latitude;
        $location->city = $city;
        $location->profile_id = $user->profile->id;

        $location->save();
        return ResponseBuilder::build($location, 200, 'Create location successfully');
    }

    public function delete(\Request $request, $location_id, User $user)
    {
        $location = Location::find($location_id);
        $location->delete();
        return ResponseBuilder::build(null, 200,'Delete location successfully');
    }
}