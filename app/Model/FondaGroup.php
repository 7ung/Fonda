<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 7:45 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class FondaGroup extends Model
{
    protected $table = 'fonda_group';

    public $timestamps = false;

    public $jsonName = 'fonda_group';

    public function fonda()
    {
        return $this->hasMany('App\Model\Fonda');
    }
}