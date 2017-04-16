<?php

namespace App\Http\Controllers;

use App\Model\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

class SaleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth_token', ['except' => ['index', 'show']]);
        $this->middleware('auth_vendor', ['except' => ['index', 'show']]);
        $this->middleware('validate_input', ['only' => ['store', 'update']]);
        $this->middleware('fonda_res');
        $this->middleware('fonda_sale_res', ['except' => ['store', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $fonda = \Route::current()->parameter('fonda');
        return ResponseBuilder::build($fonda->sales->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if ($fonda->sales()->count() >= Sale::$maxInFonda)
            return ResponseJsonBadRequest::responseBadRequest(40913);
        $sale = new Sale();
        $sale->begin_day = Input::get('begin_day');
        $sale->end_day = Input::get('end_day');
        $sale->high_light = Input::get('high_light');
        $sale->description = Input::get('description');
        $sale->fonda_id = $fonda->id;
        $sale->save();
        return ResponseBuilder::build($sale, 200, 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $sale = \Route::current()->fonda_sale;
        return ResponseBuilder::build($sale);
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
        $sale = \Route::current()->fonda_sale;
        $sale->begin_day = Input::get('begin_day');
        $sale->end_day = Input::get('end_day');
        $sale->high_light = Input::get('high_light');
        $sale->description = Input::get('description');
        $sale->save();
        return ResponseBuilder::build($sale, 200, 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $sale = \Route::current()->fonda_sale;
        $sale->delete();
        return ResponseBuilder::build(null, 200, 'Delete success');
    }
}
