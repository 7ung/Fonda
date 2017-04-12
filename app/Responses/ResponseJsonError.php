<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 2:34 PM
 */

namespace Responses;

use Exception;

require_once __DIR__.'/ResponseJson.php';

class ResponseJsonError extends \Exception implements ResponseJson
{
    function __construct($message = 'Internal Server Error', $code = 500)
    {
        parent::__construct($message, $code);
    }

    function getDetail()
    {
        return '';
    }

    function serializableArray()
    {
        $rt = [
            'code' => parent::getCode(),
            'message' => parent::getMessage()
        ];
        if ($this->getDetail() != null)
        {
            $rt['reason'] = $this->getDetail();
        }
        return $rt;
    }

}