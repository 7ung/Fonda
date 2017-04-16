<?php

namespace App\Http\Controllers;

use App\Model\Culinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;


require_once __DIR__.'/../../Responses/_loader.php';
require_once __DIR__.'/../../Exceptions/_loader.php';


class CulinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $name = Input::get('name');
        if (empty($name) == false)
            $rs = Culinary::leftJoin('fonda_culinary', 'culinary.id', '=', 'fonda_culinary.culinary_id')
                ->selectRaw('culinary.*, count(fonda_culinary.fonda_id) as fonda_count')
                ->where('culinary.name', 'like', '%'.$name.'%')
                ->groupBy('culinary.id');
        else
            $rs = Culinary::leftJoin('fonda_culinary', 'culinary.id', '=', 'fonda_culinary.culinary_id')
                ->selectRaw('culinary.*, count(fonda_culinary.fonda_id) as fonda_count')
                ->groupBy('culinary.id');
        $rs = $rs->orderBy('fonda_count', 'desc')        // Xếp theo thứ tự giảm dần số fonda
            ->orderBy('name')                        // Xếp theo thứ tự tăng dần tên
            ->take(Culinary::$numberToSelect)
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
            ResponseJsonBadRequest::responseBadRequest(40020);

        $culinary = new Culinary();
        $culinary->name = $name;
        $culinary->save();
        return ResponseBuilder::build($culinary, 200, 'Create success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
