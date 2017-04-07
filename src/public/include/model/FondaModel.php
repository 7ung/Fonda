<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 7:38 PM
 */

namespace model;


use entities\Fonda;

class FondaModel extends BaseModel
{
    public function create(Fonda $fonda){
        $stmt = $this->prepare(Fonda::$queries['create']);
        $stmt->bind_param('siiississii', $fonda->name, $fonda->locationId, $fonda->groupId, $fonda->scale,
            $fonda->openTime, $fonda->closeTime, $fonda->openDay, $fonda->phone1, $fonda->phone2,
            $fonda->user_id, $fonda->active);
        return $this->execute($stmt, function(){
        });

    }

    public function save(Fonda $fonda){
        $stmt = $this->prepare(Fonda::$queries['update']);
        $stmt->bind_param('siiississii', $fonda->name, $fonda->locationId, $fonda->groupId, $fonda->scale, $fonda->openTime,
            $fonda->closeTime, $fonda->openDay, $fonda->phone1, $fonda->phone2, $fonda->active, $fonda->id);
        return $this->execute($stmt, function () use ($stmt){
            if ($stmt->affected_rows == 0)
                return false;
            return true;
        });
    }

    /**
     * @param $id
     * @return Fonda
     */
    public function findFondaById($id){
        $stmt = $this->prepare(Fonda::$queries['findById'], 'i', $id);
        return $this->execute($stmt, function () use ($stmt){
            if ($stmt->affected_rows == 0)
                return null;
            $fonda = new Fonda();
            $stmt->bind_result( $fonda->id, $fonda->name, $fonda->locationId, $fonda->groupId,
                $fonda->scale, $fonda->openTime, $fonda->closeTime, $fonda->openDay,
                $fonda->phone1, $fonda->phone2, $fonda->user_id, $fonda->active);

            if ($stmt->fetch())
                return $fonda;
            return null;
        });
    }
}