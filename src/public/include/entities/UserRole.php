<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 11:59 AM
 */

namespace entities;


use model\BaseModel;
use responses\ResponseJsonData;

class UserRole extends ResponseJsonData
{
    public static $queries = [
        'findByCode' => 'select id, code, name from user_role where code = ?'
    ];

    public $id = 0;

    public $code = '';

    public $name = '';


    function serializableArray()
    {
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
        $rs[$_n]['id'] = $this->id;
        $rs[$_n]['code'] = $this->code;
        $rs[$_n]['name'] = $this->name;

        return $rs;
    }


    function name()
    {
        return 'user_role';
    }
}