<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:35 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    public $timestamps = false;

    public $jsonName = 'comment';

    public static $paging = 12;


}