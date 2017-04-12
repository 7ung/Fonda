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

//
//    public function profile()
//    {
//        return $this->hasOne('App\Model\Profile');
//    }


}