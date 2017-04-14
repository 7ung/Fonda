<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:32 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Dainty extends Model
{
    protected $table = 'dainty';

    public $timestamps = false;

    public $jsonName = 'dainty';
}