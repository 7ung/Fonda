<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 8:24 PM
 */

namespace entities;


use responses\ResponseJsonData;

class FondaGroup extends ResponseJsonData
{
    public static $queries = [
        'findById' => 'select id, name from fonda_group where id = ?'
    ];

    public $id;

    public $name;

    public function serializableArray()
    {
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
        $rs[$_n]['id'] = $this->id;
        $rs[$_n]['name'] = $this->name;
        return $rs;
    }

    function name()
    {
        return 'fonda_group';
    }
}