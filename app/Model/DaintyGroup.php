<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:33 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class DaintyGroup extends Model
{
    protected $table = 'dainty_group';

    public $timestamps = false;

    public $jsonName = 'dainty_group';
}