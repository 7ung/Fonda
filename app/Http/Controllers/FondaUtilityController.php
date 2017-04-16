<?php

namespace App\Http\Controllers;

use App\Model\FondaUtility;
use App\Model\Utility;
use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Exceptions/_loader.php';

class FondaUtilityController extends Controller
{
    function __construct()
    {
        $this->middleware('auth_token', ['except' => ['index','show']]);
        $this->middleware('auth_vendor', ['except' => ['index','show']]);
        $this->middleware('validate_input', ['only' => ['store', 'update']]);
        $this->middleware('fonda_res');
        $this->middleware('fonda_utility_res', ['except' => ['index', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $fonda = \Route::current()->fonda;
        return ResponseBuilder::build($fonda->utilities->toArray());
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
        $fonda = \Route::current()->fonda;
        $fondaUtility = new FondaUtility();

        if ($fonda->utilities()->count() >= FondaUtility::$maxInFonda)
            return ResponseJsonBadRequest::responseBadRequest(40915);

        $utilityName = Input::get('utility_name');
        $utilityId = Input::get('utility_id');
        if ($utilityName != null){
            $utility = Utility::where('name','=',$utilityName)->first();
            if ($utility == null){
                $utility = new Utility();
                $utility->name = $utilityName;
            }

        }
        else {
            if ($utilityId == null)
                return ResponseJsonBadRequest::responseBadRequest(40016);
            $utility = Utility::find($utilityId);
            if ($utility == null)
                return ResponseJsonBadRequest::responseBadRequest(40415);

        }
        if ($fonda->utilities()->where('utility_id', '=', $utility->id)->first() != null)
            return ResponseJsonBadRequest::responseBadRequest(40916);

        $fondaUtility->description = Input::get('description');
        $fondaUtility->fonda_id = $fonda->id;
        try{
            DB::beginTransaction();
            if ($utilityName != null){
                $utility->save();
                $fondaUtility->utility_id = $utility->id;
            }
            else {
                $fondaUtility->utility_id = $utilityId;
            }
            $fondaUtility->save();
            DB::commit();
//            $fondaUtility->utility;
            return ResponseBuilder::build($fondaUtility, 200, 'Create success');
        }catch (QueryException $queryException){
            DB::rollBack();
            throw new MySqlExecuteFailException($queryException->getMessage());
        }

//        $fondaUtility->description = Input::get('description');
//        $fondaUtility->fonda_id = $fonda->id;
//        $fondaUtility->save();
//        return ResponseBuilder::build($fondaUtility, 200, 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $fondaUtility = \Route::current()->fonda_utility;
        return ResponseBuilder::build($fondaUtility);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function edit($id)
    {
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
        $fonda = \Route::current()->fonda;
        $fondaUtility = \Route::current()->fonda_utility;

        $fonda->utilities()->where('fonda_id', '=', $fonda->id)
            ->where('utility_id','=', $fondaUtility->utility_id)
            ->take(1)
            ->update(['description' => Input::get('description')]);

        return ResponseBuilder::build($fondaUtility, 200, 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $fondaUtility = \Route::current()->fonda_utility;
        $fondaUtility->delete();
        return ResponseBuilder::build(null, 200, 'Detele success');
    }
}
