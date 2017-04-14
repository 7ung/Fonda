<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 8:01 PM
 */

namespace App\Http\Controllers;


use App\Model\Image;
use App\Model\User;
use function Common\base64_to_jpeg;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';

class ImageController extends Controller
{

    protected static $imgPath = __DIR__.'/../../../storage/img';

    /**
     * Upload hình ảnh cho user
     * URL:         /users/{id}/image
     * METHOD       POST
     * Params
     *              token - required
     *              image_base64 - required - Chú ý Prefix: data:image/jpeg;base64,
     *              description - non-required :
     *
     * @param \Request $request
     * @param $userId
     * @param User $user
     * @return array
     */
    public function store(\Request $request, $userId, User $user)
    {

        $imageBase64 = Input::get('image_base64');
        if (empty($imageBase64))
            return ResponseJsonBadRequest::responseBadRequest(40007);

        $userFolder = self::$imgPath.'/'.$user->id;
        if (is_dir($userFolder) == false)
            mkdir($userFolder);

        $fileName = $userFolder.'/0.jpg';
        base64_to_jpeg($imageBase64, $fileName);

        $image = new Image();
        $image->description = Input::get('description');
        $image->upload_date = $_SERVER['REQUEST_TIME'];
        $image->user_id = $user->id;
        $image->url = $fileName;
        $image->save();

        $newFileName = $userFolder.'/'.$image->id.'.jpg';
        rename($fileName, $newFileName);

        $image->url = \URL::to('/').'/storage/img/'.$user->id.'/'.$image->id.'.jpg';
        $image->save();

        return ResponseBuilder::build($image, 200, 'Upload file successfully');
    }

    public function index(\Request $request, $userId, User $user)
    {
        $images = Image::where('user_id', '=', $userId)->paginate(8);
        return ResponseBuilder::build($images->toArray());
    }

    public function show(\Request $request, $userId, $imageId, User $user, Image $image)
    {
        return ResponseBuilder::build($image);
    }

    public function update(\Request $request, $userId, $imageId, User $user, Image $image)
    {
        $image->description = Input::get('description');
        $image->save();
        return ResponseBuilder::build($image, 200, 'Update image successfully');
    }

    public function delete(\Request $request, $userId, $imageId, User $user, Image $image)
    {
        \Illuminate\Support\Facades\File::delete($image->url);
        $image->delete();
        return ResponseBuilder::build(null, 200, 'Delete image successfully');
    }
}