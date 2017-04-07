<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 8:50 PM
 */

namespace model;


use entities\Location;

class LocationModel extends BaseModel
{

    public function findLocationById($id){
        $stmt = $this->prepare(Location::$queries['findById'], 'i', $id);
        return $this->execute($stmt, function () use ($stmt){
           if ($stmt->affected_rows == 0)
               return null;
           $location = new Location();
           $stmt->bind_result($location->id, $location->longitude, $location->latitude, $location->city);
           if ($stmt->fetch())
               return $location;
           return null;
        });
    }
}