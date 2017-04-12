<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:22 PM
 */

namespace Responses;


abstract class ResponseJsonData implements ResponseJson
{

    /**
     * @return string
     */
    abstract function name();
    function serializableArray()
    {
        // TODO: Implement serializableArray() method.
        return null;
    }
}