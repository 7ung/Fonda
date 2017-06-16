<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/10/2017
 * Time: 7:07 PM
 */

namespace App\Http\Controllers;



use App\Http\Middleware\ResourcesMiddleware\LocationResource;
use App\Model\Culinary;
use App\Model\Dainty;
use App\Model\Fonda;
use App\Model\FondaGroup;
use App\Model\Location;
use App\Model\User;
use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Exceptions/_loader.php';

class FondaController extends Controller
{

    function index(){
        $name =  Input::get('name');
        $groupName = Input::get('group_name');
        $scale = Input::get('scale');
        $city = Input::get('city');
        $address = Input::get('address');
        $isSale = Input::get('is_sale');
        $culinaryId = Input::get('culinary_id');
        $daintyName = Input::get('dainty_name');

        $location_array = explode(',',Input::get('location'));
        $location =  null;
        if (empty(Input::get('location')) == false) {
            $location = new Location();
            $location->longitude = floatval($location_array[1]);
            $location->latitude  = floatval($location_array[0]);
        }

        $rs = null;
        if ($location != null) {
            $rs = Fonda::leftJoin('location', 'fonda.id', '=', 'location.fonda_id')
                ->selectRaw('fonda.*,  ((location.longitude - ?) * (location.longitude - ?) + (location.latitude - ?) * (location.latitude - ?))  as distance ',
                    [$location->longitude, $location->longitude, $location->latitude, $location->latitude])
                ->groupBy('fonda.id');

            $rs = $rs->orderBy('distance', 'asc');


//            $rs = $rs
//                ->paginate(4);
//            return ResponseBuilder::build($rs);
        }

        if ($rs == null)
            $rs = Fonda::where('active', '=',1)
                ->with(['group', 'location','utilities','culinaries', 'sales'])
                ->orderBy('date', 'desc');
        else
            $rs = $rs->where('active', '=',1)
                ->with(['group', 'location','utilities','culinaries', 'sales'])
                ->orderBy('date', 'desc');

        // Tìm kiếm theo tên
        if (empty($name) == false)
            $rs = $rs->where('name','LIKE', '%'.$name.'%');

        if (empty($groupName) == false)
            $rs = $rs->whereHas('group',function ($query) use ($groupName){
                $query->where('name','LIKE', '%'.$groupName.'%');
            });

        if (empty($scale) == false)
            $rs = $rs->where('scale', '=', $scale);

        if (empty($city) == false)
            $rs = $rs->whereHas('location', function ($query) use ($city){
               $query->where('city', '=', $city);
            });

        if (empty($address) == false)
            $rs = $rs->whereHas('location', function ($query) use ($address){
                $query->where('address', 'like', '%'.$address.'%');
            });

        if ($isSale === '1')
            $rs = $rs->has('sales');

        if ( $isSale === '0')
            $rs = $rs->doesntHave('sales');

        if (empty($culinaryId) == false)
            $rs = $rs->whereHas('culinaries', function ($query) use ($culinaryId){
                $query->where('culinary_id', '=', $culinaryId);
            });

        if (empty($daintyName) == false)
            $rs = $rs->whereHas('dainty', function ($query) use ($daintyName){
                $query->where('name', 'LIKE', '%'.$daintyName.'%');
            });

//        // location from request param


        $rs = $rs
			->paginate(4);
        return ResponseBuilder::build($rs);
    }

    function show(\Request $request, $id, Fonda $fonda)
    {
        $fonda->group;
        $fonda->location;
        $fonda->utilities;
        $fonda->culinaries;
		$fonda->sales;
        return ResponseBuilder::build($fonda);
    }

    /**
     * Request param :
     *          name
     *          group_id
     *          scale
     *          open_time
     *          close_time
     *          phone_1
     *          phone_2
     *          location
     *          token
     * @param \Request $request
     * @param User $user
     * @return array
     * @throws MySqlExecuteFailException
     */
    function store(\Request $request, User $user)
    {
        $fonda = new Fonda();

        $fonda->name = Input::get('name');
        if (empty($fonda->name))
            return ResponseJsonBadRequest::responseBadRequest(40010);

        // Nhập param là group name, nếu chưa có thì tạo một group với groụp_name
        // nếu có rồi thì get group by group name
        // nếu không có group name thì get group by group id
        // nếu không có group id thì quăng lỗi
        $groupName = Input::get('group_name');
        if ($groupName == null){
            $groupId = Input::get('group_id');
            if (empty($groupId))
                return ResponseJsonBadRequest::responseBadRequest(40011);
            $group = FondaGroup::find($groupId);
            if ($group == null)
                return ResponseJsonBadRequest::responseBadRequest(40411);
        }
        else{
            $group = FondaGroup::where('name', '=',$groupName)->first();
            if ($group == null) {
                $group = new FondaGroup();
                $group->name = $groupName;
            }
        }


        $fonda->scale = Input::get('scale');
        if (empty($fonda->scale))
            return ResponseJsonBadRequest::responseBadRequest(40012);

        $openTimeString = Input::get('open_time');
        $closeTimeString = Input::get('close_time');
        $fonda->open_time = $openTimeString;
        $fonda->close_time = $closeTimeString;

        $fonda->phone_1 = Input::get('phone_1');
        $fonda->phone_2 = Input::get('phone_2');

        $fonda->user_id = $user->id;
        $fonda->active = 1;

        $open_date = Input::get('open_day');
        $fonda->open_day = $open_date;

        $location = null;
        if (empty(Input::get('location')) == false)
        {
            $locationArray = explode(',',Input::get('location'));
            if (count($locationArray) != 0) {
                $location = new Location();
                $location->longitude = $locationArray[1];
                $location->latitude = $locationArray[0];

                $location->city = Input::get('city');
                $location->province = Input::get('province');
                $location->place_id = Input::get('place_id');
            }
        }

        $address = Input::get('address');
        if (empty($address) == false && $location != null){
            $location->address = $address;
        }

        $fonda->description = Input::get('description');
        $fonda->date = $_SERVER['REQUEST_TIME'];
        try{
            DB::beginTransaction();
            if ($group != null){
                $group->save();
            }

            $fonda->group_id = $group->id;
            $fonda->save();
            $fonda->group;

            if($location != null) {
                $location->fonda_id = $fonda->id;
                $location->save();
            }
            DB::commit();
            return ResponseBuilder::build($fonda);
        }
        catch(QueryException $queryException)
        {
            DB::rollBack();
            throw new MySqlExecuteFailException($queryException->getMessage());
        }
    }


    function update(\Request $request, $id, User $user, Fonda $fonda)
    {
        $name = Input::get('name');
        if (empty($name) == false)
            $fonda->name = $name;

        $group_id = Input::get('group_id');
        if (empty($group_id) != false)
            $fonda->group_id = $group_id;

        $scale = Input::get('scale');
        if (empty($scale) == false)
            $fonda->scale = $scale;

        $openTimeString = Input::get('open_time');
        $closeTimeString = Input::get('close_time');
        //if (empty($openTimeString) == false && empty($closeTimeString) == false)
        if (empty($openTimeString) == false)
        {
            $fonda->open_time = $openTimeString;
        }
        if (empty($closeTimeString) == false)
        {
            $fonda->close_time = $closeTimeString;
        }

        $phone_1 = Input::get('phone_1');
        if (empty($phone_1) == false)
            $fonda->phone_1 = $phone_1;

        $phone_2 = Input::get('phone_2');
        if (empty($phone_2) == false)
            $fonda->phone_2 = $phone_2;

        $active = Input::get('active');
        if (empty($active) == false)
            $fonda->active = $active;

        $openDay = Input::get('open_day');
        if (empty($openDay) == false)
            $fonda->open_day = $openDay;

        if (empty(Input::get('location')) == false)
        {
            $locationArray = explode(',',Input::get('location'));
            if (count($locationArray) != 0) {
                $fonda->location->longitude = $locationArray[1];
                $fonda->location->latitude = $locationArray[0];
            }
        }
        if (Input::get('city') != '')
            $fonda->location->city = Input::get('city');
        if (Input::get('address') != '')
            $fonda->location->address = Input::get('address');
        if (Input::get('province') != '')
            $fonda->location->province = Input::get('province');
        if (Input::get('place_id') != '')
            $fonda->location->place_id = Input::get('place_id');
        if (Input::get('description') != '')
            $fonda->description = Input::get('description');

        try{
            DB::beginTransaction();
            $fonda->location->save();
            $fonda->save();
            $fonda->location->makeHidden(['profile_id']);
            DB::commit();

            $fonda = Fonda::find($fonda->id);
            $fonda->group;
            $fonda->location;
            $fonda->utilities;
            $fonda->culinaries;
            $fonda->sales;
            return ResponseBuilder::build($fonda, 200, 'Update success');
        }
        catch(QueryException $queryException)
        {
            DB::rollBack();
            throw new MySqlExecuteFailException($queryException->getMessage());
        }

    }

}