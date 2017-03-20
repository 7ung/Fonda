<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/20/2017
 * Time: 8:17 AM
 */

namespace entities;


use responses\ResponseJsonData;

class VerifyStatus extends ResponseJsonData
{
    public $id;

    public $userId;

    public $code;

    public $expired;

    public $triedTime;

    public $status;

    public $user;

    function __construct()
    {
    }

    function serializableArray()
    {
        $rs = array(
            'verify_info' => array()
        );
        if ($this->id != null)
            $rs['verify_info']['id'] = $this->id;
        if ($this->userId != null)
            $rs['verify_info']['user_id'] = $this->userId;
        if ($this->code != null)
            $rs['verify_info']['code'] = $this->code;
        if ($this->expired != null)
            $rs['verify_info']['expired'] = $this->expired;
        if ($this->triedTime != null)
            $rs['verify_info']['tried_time'] = $this->triedTime;
        if ($this->status != null)
            $rs['verify_info']['status'] = $this->status;
        return $rs;
    }
}