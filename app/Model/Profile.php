<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 8:38 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * @property string first_name
 * @property string last_name
 * @property string dob
 * @property string gender
 * @property int location_id
 * @property int profile_picture_id
 * @property int user_id
 */
class Profile extends Model
{
    protected $table = 'profile';

    public $timestamps = false;

    public $jsonName = 'profile';


//    public $visible = [ 'location', 'image'];

//    public function user()
//    {
//        return $this->hasOne('App\Model\User');
//    }

    public function location()
    {
        return $this->hasOne('App\Model\Location');
    }

    public function image()
    {
        return $this->belongsTo('App\Model\Image','profile_picture_id');
    }

    public static function createByUser(User $user)
    {
        $profile = new Profile();
        $names = [
            'Siêu nhơn ăn vặt',
            'Đại gia nhà hàng',
            'Thiếu gia thiếu nợ',
            'Cô chủ củ chuối'
        ];

        $profile->first_name = $names[random_int(0,3)].' '.$user->id;
        $profile->last_name = null;
        $profile->dob = null;
        $profile->gender = 'female';
        $profile->profile_picture_id = null;
        $profile->user_id = $user->id;

        return $profile->save();
    }

    public static function dumm()
    {
        return Profile::with(['image', 'location'])->find(10);
    }
}