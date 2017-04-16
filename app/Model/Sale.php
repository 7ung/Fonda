<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/14/2017
 * Time: 8:56 AM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';

    public $timestamps = false;

    public $jsonName = 'sale';

    public static $maxInFonda = 4;

    protected $hidden = ['fonda'];

    public function fonda()
    {
        return $this->belongsTo('App\Model\Fonda');
    }

    public static function dumm()
    {
        return Fonda::find(2);
    }

}