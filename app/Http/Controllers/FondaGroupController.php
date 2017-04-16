<?php

namespace App\Http\Controllers;

use App\Model\Fonda;
use App\Model\FondaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Exceptions/_loader.php';

class FondaGroupController extends Controller
{
    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $name = Input::get('name');
        if (empty($name) == false)
            $rs = FondaGroup::leftJoin('fonda', 'fonda_group.id', '=', 'fonda.group_id')
                ->selectRaw('fonda_group.*, count(fonda.id) as fonda_count')
                ->where('fonda_group.name', 'like', '%'.$name.'%')
                ->groupBy('fonda_group.id');

        else
            $rs = FondaGroup::leftJoin('fonda', 'fonda_group.id', '=', 'fonda.group_id')
                ->selectRaw('fonda_group.*, count(fonda.id) as fonda_count')
                ->groupBy('fonda_group.id');            // get all

        $rs = $rs->orderBy('fonda_count', 'desc')        // Xếp theo thứ tự giảm dần số fonda
                ->orderBy('name')                        // Xếp theo thứ tự tăng dần tên
                ->take(FondaGroup::$numberToSelect)
                ->get();

        return ResponseBuilder::build($rs->toArray());
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
        $name = Input::get('name');
        if (empty($name) == false)
            ResponseJsonBadRequest::responseBadRequest(40018);

        $fondaGroup = new FondaGroup();
        $fondaGroup->name = $name;
        $fondaGroup->save();
        return ResponseBuilder::build($fondaGroup, 200, 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
