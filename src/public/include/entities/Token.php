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
        'create' => 'insert into access_token(access_token, expired, user_id) values(?, ?, ?)',
        'findByUserId' => 'select id, access_token, expired, user_id from access_token where (user_id = ?)',
        'findByToken' => 'select id, access_token, expired, user_id from access_token where (access_token = ?)'
    ];
    public $id = 0;

    public $userId = 0;

    public $token = null;

    public $expired = 0;

    public $user;

    function serializableArray()
    {
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
//        if ($this->id !== 0)
//            $rs['access_token']['id'] = $this->id;
        if ($this->userId !== 0)
            $rs[$_n]['userId'] = $this->userId;
        if ($this->token !== null)
            $rs[$_n]['token'] = \common\removeHashPrefix($this->token);
        if ($this->expired !== 0)
            $rs[$_n]['expired'] = $this->expired;
        return $rs;

    }

    public function name(){
        return 'access_token';
    }
}