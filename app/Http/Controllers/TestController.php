<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 8:52 PM
 */

namespace App\Http\Controllers;


use App\Model\Image;
use App\Model\Profile;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Responses\ResponseBuilder;

require_once __DIR__ . '/../../Responses/_loader.php';


class TestController
{
    public function action()
    {
        $images = Image::where('id', '=', 1)->paginate(10);

        return ResponseBuilder::build($images->toArray());


    }
}