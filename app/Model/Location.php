<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:17 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    public $timestamps = false;

    public $jsonName = 'location';

    protected $hidden = ['profile_id'];

    public function profile()
    {
        return $this->belongsTo('App\Model\Profile');
    }

    public function fonda()
    {
        return $this->belongsTo('App\Model\Fonda');
    }

    public static function dummMany()
    {
       return Location::where('profile_id', '=', 10)->paginate(4)->toJson();
    }

    public static function dumm()
    {
        $location = new Location();
        $location->longitude = 13.141;
        $location->latitude = 95.4819;
        $location->profile_id = 0;
        $location->id = 0;
        $location->city = 'HCM';
        return $location;
    }

}