<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:33 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * @property  dainty
 */
class FondaDainty extends Model
{
    protected $table = 'fonda_dainty';

    public $timestamps = false;

    public $jsonName = 'fonda_dainty';

    protected $appends = ['name', 'dainty_group'];

    protected $hidden = ['dainty', 'dainty_group'];

    public function dainty()
    {
        return $this->belongsTo('App\Model\Dainty');
    }

    public function dainty_group()
    {
        return $this->belongsTo('App\Model\DaintyGroup');
    }

    public function getNameAttribute()
    {
        return $this->dainty->name;
    }

    public function getGroupAttribute()
    {
        return $this->dainty_group->name;
    }
}