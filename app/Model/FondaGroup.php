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

    public $appends = ['fonda_count'];

    public static $numberToSelect = 8;

    public function fonda()
    {
        return $this->hasMany('App\Model\Fonda', 'group_id', 'id');
    }

    public function getFondaCountAttribute()
    {
        return $this->fonda()->count();
    }
    public static function dumm()
    {
        $fondaGroup = new FondaGroup();
        $fondaGroup->name = 'dumm name';
        $fondaGroup->id = 0;
        return $fondaGroup;
    }
}