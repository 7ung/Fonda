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
use function Common\base64_to_jpeg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;

require_once __DIR__ . '/../../Responses/_loader.php';
require_once __DIR__.'/../../Common/_loader.php';

class TestController extends Controller
{
    public function action()
    {

        $image = Input::get('image_base64');
        $path1 = __DIR__.'/../../../storage/img/92';
        $path2 = __DIR__.'/../../../storage/img/93';

////        $myfile = fopen($path, "wb");
//        base64_to_jpeg($image, $path);
        mkdir($path2, 0777, true);
        if (is_dir($path2))
            return ['success'];
        return ['fail'];
    }



}