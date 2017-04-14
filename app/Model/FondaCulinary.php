<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/14/2017
 * Time: 9:48 AM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class FondaCulinary extends Model
{
    protected $table = 'fonda_culinary';

    public $timestamps = false;

    public $jsonName = 'fonda_culinary';

    protected $appends = ['name'];

    protected $hidden = ['culinary'];

    public function culinary()
    {
        return $this->belongsTo('App\Model\Culinary');
    }

    public function getNameAttribute()
    {
        return $this->culinary->name;
    }
}