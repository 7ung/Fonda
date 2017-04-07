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
    public static $queries = [
        'save' => 'update verify_status set code = ?, expired = ?, tried_time = ?, status = ? where id = ?'
    ];
    public $id = -1;

    public $userId = -1;

    public $code = null;

    public $expired = -1;

    public $triedTime = -1;

    public $status = -1;

    public $user = null;


    function __construct()
    {
    }

    function serializableArray()
    {
        $name = $this->name();
        $rs = array(
            $name => array()
        );
        if ($this->id !== -1)
            $rs[$name]['id'] = $this->id;
        if ($this->userId !== -1)
            $rs[$name]['user_id'] = $this->userId;
//        if ($this->code != null)
//            $rs['verify_info']['code'] = $this->code; // not allow client view code
        if ($this->expired !== -1)
            $rs[$name]['expired'] = $this->expired;
        if ($this->triedTime !== -1)
            $rs[$name]['tried_time'] = $this->triedTime;
        if ($this->status !== -1)
            $rs[$name]['status'] = $this->status;
        return $rs;
    }

    function name()
    {
        return 'verify_status';
    }
}