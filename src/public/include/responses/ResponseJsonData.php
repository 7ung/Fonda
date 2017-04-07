<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:22 PM
 */

namespace responses;


abstract class ResponseJsonData implements ResponseJson
{

    abstract function name();
    function serializableArray()
    {
        // TODO: Implement serializableArray() method.
        return null;
    }
}