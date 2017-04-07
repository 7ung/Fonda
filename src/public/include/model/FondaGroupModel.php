<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 9:00 PM
 */

namespace model;


use entities\FondaGroup;

class FondaGroupModel extends BaseModel
{
    public function findFondaGroupById($id){
        $stmt = $this->prepare(FondaGroup::$queries['findById'], 'i', $id);
        return $this->execute($stmt, function () use ($stmt){
            if ($stmt->affected_rows == 0)
                return null;
            $fondaGroup = new FondaGroup();
            $stmt->bind_result($fondaGroup->id, $fondaGroup->name);
            if ($stmt->fetch())
                return $fondaGroup;
            return null;
        });
    }
}