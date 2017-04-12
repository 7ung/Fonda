<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/10/2017
 * Time: 7:07 PM
 */

namespace App\Http\Controllers;



use App\Model\Fonda;

class FondaController extends Controller
{

    function index($id){
        return Fonda::whereKey($id)->get();
    }
}