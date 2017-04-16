<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:40 PM
 */

namespace App\Model;


use function Common\base64_to_jpeg;
use Illuminate\Database\Eloquent\Model;

require_once __DIR__.'/../Common/_loader.php';

class Image extends Model
{

    protected $table = 'image';

    public $timestamps = false;

    public $jsonName = 'image';

    protected $hidden = ['local_path'];

    public static function createDefault($userId)
    {
        static $defaultImgPath = '/storage/default/profile_picture.jpg';
        $image = new Image();
        $image->url = 'http://'.$_SERVER['HTTP_HOST'].$defaultImgPath;
        $image->description = 'Default picture';
        $image->upload_date = $_SERVER['REQUEST_TIME'];
        $image->user_id = $userId;
        $image->save();
    }

    public static function upload($imageBase64, $userId)
    {

        $imgPath = __DIR__.'/../../storage/img';
        $userFolder = $imgPath.'/'.$userId;
        if (is_dir($userFolder) == false)
            mkdir($userFolder);

        $fileName = $userFolder.'/0.jpg';
        base64_to_jpeg($imageBase64, $fileName);
        return $fileName;
    }

    public function profile()
    {
        return $this->hasOne('App\Model\Profile','profile_picture_id','id');
    }

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