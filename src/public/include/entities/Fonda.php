<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 7:56 PM
 */

namespace entities;


use responses\ResponseJsonData;

class Fonda extends ResponseJsonData
{

    public static $queries = [
        'create' => 'insert into 
                fonda(name, location_id, group_id, scale, open_time, close_time, open_day, phone_1, phone_2, user_id, active) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',

        'update' => 'update fonda set name = ?, location_id = ?, group_id = ?, scale = ?, open_time = ?, close_time = ?,
                open_day = ?, phone_1 = ?, phone_2 = ?, active = ? where  id = ?',

        'findById' => 'select id, name, location_id, group_id, scale, open_time, close_time, open_day, phone_1, phone_2, user_id, active
                from fonda where (id = ?)'


    ];
    public $id = 0;

    public $name = null;

    public $locationId = 0;

    public $groupId = 0;

    public $scale = 0;

    public $openTime = 0;

    public $closeTime = 0;

    public $openDay = 0;        // dùng kỹ thuật dịch bit cho 7 ngày trong tuần

    public $phone1 = null;

    public $phone2 = null;

    public $user_id = null;

    public $active = 1;

    // related Object

    public $location = null;

    public $group = null;

    public $user = null;

    function serializableArray(){
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
        $rs[$_n]['id'] = $this->id;
        $rs[$_n]['name'] = $this->name;
        $rs[$_n]['location_id'] = $this->locationId;
        $rs[$_n]['group_id'] = $this->groupId;
        $rs[$_n]['scale'] = $this->scale;
        $rs[$_n]['open_time'] = $this->openTime;
        $rs[$_n]['close_time'] = $this->closeTime;
        $rs[$_n]['open_day'] = $this->openDay;
        $rs[$_n]['phone_1'] = $this->phone1;
        $rs[$_n]['phone_2'] = $this->phone2;
        $rs[$_n]['user_id'] = $this->user_id;
        $rs[$_n]['is_active'] = $this->active;

        if ($this->location != null)
            $rs[$_n]['location'] = $this->location->serializableArray()['location'];
        if ($this->group != null)
            $rs[$_n]['fonda_group'] = $this->group->serializableArray()['fonda_group'];
        if ($this->user != null)
            $rs[$_n]['user'] = $this->user->serializableArray()['user'];
        return $rs;
    }

    function name()
    {
        return 'fonda';
    }
}