<?php

namespace App\Http\Controllers;

use App\Model\Culinary;
use App\Model\FondaCulinary;
use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Exceptions/_loader.php';

class FondaCulinaryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth_token', ['except' => ['index','show']]);
        $this->middleware('auth_vendor', ['except' => ['index','show']]);
        $this->middleware('validate_input', ['only' => ['store', 'update']]);
        $this->middleware('fonda_res');
        $this->middleware('fonda_culinary_res', ['except' => ['index', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $fonda = \Route::current()->fonda;

        $rs = FondaCulinary::leftJoin('culinary', 'fonda_culinary.culinary_id', '=', 'culinary.id')
            ->selectRaw('fonda_culinary.*, culinary.name as name')
            ->where('fonda_culinary.fonda_id', '=', $fonda->id )
            ->groupBy('fonda_culinary.fonda_id','fonda_culinary.culinary_id');

        $rs = $rs->orderBy('name')->get();
        return ResponseBuilder::build($rs->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $culinaryId = Input::get('culinary_id');
        $fonda = \Route::current()->fonda;

        if ($fonda->culinaries()->count() >= FondaCulinary::$maxInFonda)
            return ResponseJsonBadRequest::responseBadRequest(40920);


        $culinaryName = Input::get('culinary_name');
        if ($culinaryName == null){
            if (empty($culinaryId))
                return ResponseJsonBadRequest::responseBadRequest(40021);
            $culinary = Culinary::find($culinaryId);
            if ($culinary == null)
                return ResponseJsonBadRequest::responseBadRequest(40420);

        }
        else{
            $culinary = Culinary::where('name', '=',$culinaryName)->first();
            if ($culinary == null){
                $culinary = new Culinary();
                $culinary->name = $culinaryName;
            }
        }
        if ($fonda->culinaries()->where('culinary_id', '=', $culinaryId)->first() != null)
            return ResponseJsonBadRequest::responseBadRequest(40921);


        $fondaCulinary = new FondaCulinary();
        $fondaCulinary->fonda_id = $fonda->id;

        try{
            DB::beginTransaction();
            if ($culinaryName != null){
                $culinary->save();
                $fondaCulinary->culinary_id = $culinary->id;
            }
            else {
                $fondaCulinary->culinary_id = $culinaryId;
            }
            $fondaCulinary->save();
            DB::commit();
            $fondaCulinary->culinary;
            return ResponseBuilder::build($fondaCulinary, 200, 'Create success');
        }catch (QueryException $queryException){
            DB::rollBack();
            throw new MySqlExecuteFailException($queryException->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $fondaCulinary = \Route::current()->fonda_culinary;
        return ResponseBuilder::build($fondaCulinary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
//        $fondaCulinary = \Route::current()->fonda_culinary;
//        $fondaCulinary->delete();
//        return ResponseBuilder::build(null, 200, 'Delete success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $fondaCulinary = \Route::current()->fonda_culinary;
        $fondaCulinary->delete();
        return ResponseBuilder::build(null, 200, 'Detele success');
    }
}
