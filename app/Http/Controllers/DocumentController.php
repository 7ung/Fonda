<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 10:15 AM
 */

namespace App\Http\Controllers;



use App\Model\DocumentRoute;


class DocumentController extends Controller
{

    public function index()
    {
        return view('document')->with([
            'routes' => DocumentRoute::$route
        ]);
    }

    public function show($id)
    {
        return view('documentshow')->with([
            'route' =>  DocumentRoute::$route[$id]
        ]);
    }


}