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
    protected $table = 'user';

    public $timestamps = false;

    public $jsonName = 'user';


}