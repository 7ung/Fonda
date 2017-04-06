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
        $rs = array(
            'user_role' => array()
        );
        $rs['user_role']['id'] = $this->id;
        $rs['user_role']['code'] = $this->code;
        $rs['user_role']['name'] = $this->name;

        return $rs;
    }


}