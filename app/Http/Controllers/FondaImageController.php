<?php

namespace App\Http\Controllers;

use App\Model\DocumentRoute;
use App\Model\Fonda;
use App\Model\Image;
use App\Model\ImageFonda;
use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

class FondaImageController extends Controller
{
    protected static $paging = 4;

    function __construct()
    {
        $this->middleware('auth_token', ['except' => ['index','show']]);
        $this->middleware('auth_vendor', ['except' => ['index','show']]);
        $this->middleware('validate_input', ['only' => ['store', 'update']]);
        $this->middleware('fonda_res');
        $this->middleware('fonda_image_res',  ['except' => ['index', 'store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * Middleware: fonda_res
     *
     * @return array
     */
    public function index()
    {
        $fonda = Route::current()->parameter('fonda');
        $images = $fonda->images()->paginate(self::$paging);
        return ResponseBuilder::build($images->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * Middleware: auth_token, auth_vendor, validate_input, fonda_res
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $imageBase64 = Input::get('image_base64');
        if (empty($imageBase64))
            return ResponseJsonBadRequest::responseBadRequest(40007);

        $user = Route::current()->parameter('user');
        $fonda = Route::current()->parameter('fonda');
        $fileName = Image::upload($imageBase64, $user->id);

        $image = new Image();
        $image->description = Input::get('description');
        $image->upload_date = $_SERVER['REQUEST_TIME'];
        $image->user_id = $user->id;
        $image->url = $fileName;

        $fondaImage = new ImageFonda();

        try {
            DB::beginTransaction();
            $image->save();
            $fondaImage->image_id = $image->id;
            $fondaImage->fonda_id = $fonda->id;
            $fondaImage->save();
            DB::commit();
        }
        catch(QueryException $queryException)
        {
            DB::rollBack();
            throw new MySqlExecuteFailException('Can not create image');
        }

        $newFileName = __DIR__.'/../../../storage/img/'.$user->id.'/'.$image->id.'.jpg';
        rename($fileName, $newFileName);

        $image->url = \URL::to('/').'/storage/img/'.$user->id.'/'.$image->id.'.jpg';
        $image->local_path = '/storage/img/'.$user->id.'/'.$image->id.'jpg';
        $image->save();
        $fondaImage = ImageFonda::find($image->id);
        return ResponseBuilder::build($fondaImage, 200, 'Upload file successfully');

    }

    /**
     * Display the specified resource.
     *
     * Middleware: fonda_res
     *
     * @param  int  $id
     * @return array
     */
    public function show($fondaId, $imageId)
    {
        $fondaImage = Route::current()->parameter('fonda_image');
        return ResponseBuilder::build($fondaImage);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $fondaImage = $request->route()->parameter('fonda_image');
        $fondaImage->img->description = Input::get('description');
        $fondaImage->img->save();
        return ResponseBuilder::build($fondaImage, 200, 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Middleware: auth_token, auth_vendor, fonda_res, fonda_image_res
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        static $root = __DIR__.'/../../..';
        $fondaImage = Route::current()->parameter('fonda_image');
        \Illuminate\Support\Facades\File::delete($root.$fondaImage->img->local_path);
        DB::transaction(function () use ($fondaImage){
            $img = $fondaImage->img;
            $fondaImage->delete();
            $img->delete();
        });
        return ResponseBuilder::build(null, 200, 'Delete success');
    }
}

