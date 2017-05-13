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

//    protected $primaryKey = ['fonda_id', 'utility_id'];

    public $jsonName = 'fonda_utility';

    public $timestamps = false;


    protected $appends = ['id', 'name'];

    protected $hidden = ['utility', 'fonda', 'utility_id'];

    public $incrementing = false;

    public static $maxInFonda = 8;

    public function utility()
    {
        return $this->belongsTo('App\Model\Utility');
    }

    public function fonda()
    {
        return $this->belongsTo('App\Model\Fonda');
    }
	
	public function getIdAttribute()
	{
		return $this->utility->id;
	}

    public function getNameAttribute()
    {
        return $this->utility->name;
    }
}