<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 12:27 AM
 */

namespace entities;


use responses\ResponseJsonData;

class Token extends ResponseJsonData
{
    private static $tableName = "access_token";



    public static $queries = [
        'findByUserId' => 'select id, access_token, expired, user_id from access_token where (user_id = ?)',
        'create' => 'insert into access_token(access_token, expired, user_id) values(?, ?, ?)'
    ];
    public $id = 0;

    public $userId = 0;

    public $token = null;

    public $expired = 0;

    public $user;

    function serializableArray()
    {
        $rs = array(
            'access_token' => array()
        );
//        if ($this->id !== 0)
//            $rs['access_token']['id'] = $this->id;
        if ($this->userId !== 0)
            $rs['access_token']['userId'] = $this->userId;
        if ($this->token !== null)
            $rs['access_token']['token'] = $this->token;
        if ($this->expired !== 0)
            $rs['access_token']['expired'] = $this->expired;
        return $rs;

    }
}