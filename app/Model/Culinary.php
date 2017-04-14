<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:30 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    protected $table = 'culinary';

    public $timestamps = false;

    public $jsonName = 'culinary';
}