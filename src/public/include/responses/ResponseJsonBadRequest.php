<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:36 PM
 */

namespace responses;

require_once __DIR__.'/ResponseJson.php';

class ResponseJsonBadRequest implements ResponseJson
{
    private $msg;

    private $status;

    private $detail;

    function __construct($message = 'Bad Request', $code = 400, $detail = '')
    {
        $this->msg = $message;
        $this->status = $code;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    function getDetail()
    {
        return $this->detail;
    }

    function serializableArray()
    {
        $rt = [
            CODE => $this->getStatus(),
            MESSAGE => $this->getMsg()
        ];
        if ($this->getDetail() != null)
        {
            $rt[REASON] = $this->getDetail();
        }
        return $rt;
    }
}