<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 9:09 PM
 */

namespace responses;

require_once __DIR__ . '/../constant.php';

interface ResponseJson
{
    function serializableArray();
}