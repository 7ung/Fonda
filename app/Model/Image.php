<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:40 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'image';

    public $timestamps = false;

    public $jsonName = 'image';


    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
//
//    public function profile()
//    {
//        return $this->hasOne('App\Model\Profile');
//    }

    public static function dummMany()
    {
        return Image::where('user_id', '=', 92)->paginate(8)->toJson();
    }


    public static function dumm()
    {
        $image = new Image();
        $image->url = 'path/file.jpg';
        $image->description = 'dumm';
        $image->upload_date = time();
        $image->user_id = 0;
        return $image;
    }
}