<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:29 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $table = 'utility';

    public $timestamps = false;

    public $jsonName = 'utility';

    public static $numberToSelect = 8;

    public function fonda()
    {
        return $this->belongsToMany('App\Model\Fonda', 'fonda_utility', 'fonda_id', 'utility_id');
    }
}