<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 8:27 PM
 */

namespace entities;


use responses\ResponseJsonData;

class Location extends ResponseJsonData
{

    public static $queries = [
        'findById' => 'select id, longitude, latitude, city from location where id = ?'
    ];
    public $id;

    public $longitude;

    public $latitude;

    public $city;

    public function serializableArray()
    {
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
        $rs[$_n]['longitude'] = $this->longitude;
        $rs[$_n]['latitude'] = $this->latitude;
        $rs[$_n]['city'] = $this->city;
        return $rs;
    }

    function name()
    {
        return 'location';
    }
}