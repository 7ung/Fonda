<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:29 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class FondaUtility extends Model
{
    protected $table = 'fonda_utility';

    public $timestamps = false;

    public $jsonName = 'fonda_utility';

    protected $appends = ['name'];

    protected $hidden = ['utility'];

    public function utility()
    {
        return $this->belongsTo('App\Model\Utility');
    }

    public function getNameAttribute()
    {
        return $this->utility->name;
    }
}