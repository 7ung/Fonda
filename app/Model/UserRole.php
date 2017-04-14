<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 7:25 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    protected $table = 'user_role';

    public $timestamps = false;

    public $jsonName = 'user_role';


    public function users()
    {
        return $this->hasMany('App\Model\User');
    }
}