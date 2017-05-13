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

class LocationController extends Controller
{

    private static $paging = 4;

    /**
     * Mỗi người dùng có thể có nhiều location.
     *
     * Url:         /users/{id}/location
     * method       get
     * params
     * @param $userId
     * @return array
     */
    public function index(\Request $request,$userId, User $user)
    {
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
    public function show(\Request $request,$userId, $location_id, User $user, Location $location)
    {
        $location->makeHidden(['profile']);
        return ResponseBuilder::build($location);
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
        $address = \Request::input('address');

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
        $location->address = $address;

        $location->save();
        return ResponseBuilder::build($location, 200, 'Create location successfully');
    }

    public function delete(\Request $request,$userId, $location_id, User $user, Location $location)
    {
        $location->delete();
        return ResponseBuilder::build(null, 200,'Delete location successfully');
    }
}