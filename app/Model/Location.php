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

    public function profile()
    {
        return $this->belongsTo('App\Model\Profile');
    }



}