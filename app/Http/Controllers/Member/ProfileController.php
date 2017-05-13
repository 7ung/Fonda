<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 8:11 PM
 */

namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Model\Location;
use App\Model\Profile;
use App\Model\User;
use Exceptions\MySqlExecuteFailException;
use Request;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__ . '/../../../Exceptions/_loader.php';
require_once __DIR__ . '/../../../Responses/_loader.php';
require_once __DIR__ . '/../../../Common/_loader.php';

class ProfileController extends Controller
{
    /**
     * Xem profile của user.
     * URL: /users/{id}/profile
     * METHOD: GET
     * Params: Khôgn có
     *
     * @param $userId
     * @return array
     */
    public function view($userId)
    {

        $profile = Profile::with(['image', 'location'])->where('user_id', '=', $userId)->first();
        return ResponseBuilder::build($profile);
    }

    /**
     * Chỉnh sửa profile của user
     * Url: /user/{id}/profile
     * Method: PUT
     * Params:
     *          token: required
     *          first_name: non-required
     *          last_name: non-required
     *          birth: non-required Format yyyy-MM-dd
     *          location_id: non-required.
     *          profile_picture_id: non-required
     *          gender: non-required : male-female-unknown
     *
     * @param Request $request
     * @param $userId
     * @param User $user
     * @return array
     * @throws MySqlExecuteFailException
     */
    public function update(\Request $request, $userId, User $user)
    {

        $first_name = Request::input('first_name');
        $last_name = Request::input('last_name');
        $birth = Request::input('birth');
        $gender = Request::input('gender');
        $profile_picture_id = Request::input('profile_picture_id');

        $profilePicture = Image::find($profile_picture_id);
        if ($profilePicture == null)
            return ResponseJsonBadRequest::responseBadRequest(40406);

        if (empty($first_name) == false)
            $user->profile->first_name = $first_name;

        if (empty($last_name) == false)
            $user->profile->last_name = $last_name;

        if (empty($birth) == false)
            $user->profile->dob = $birth;

        if (empty($gender) == false)
            $user->profile->gender = $gender;

        if (empty($profile_picture_id) == false)
            $user->profile->profile_picture_id = $profile_picture_id;

        $rs = $user->profile->save();
        if ($rs == false)
            throw new MySqlExecuteFailException('Can not update profile');

        $profile = Profile::with(['location','image'])->first();

        return ResponseBuilder::build($profile);
    }

    public function getByToken(\Request $request, User $user){
        $profile = Profile::with(['image', 'location'])->where('user_id', '=', $user->id)->first();
        return ResponseBuilder::build($profile);
    }
}