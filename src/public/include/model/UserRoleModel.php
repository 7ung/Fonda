<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 12:02 PM
 */

namespace model;


use entities\UserRole;

class UserRoleModel extends BaseModel
{
    public function findByCode($code){
        $stmt = $this->prepare(UserRole::$queries['findByCode'], 's', $code);
        return $this->execute($stmt, function () use ($stmt){
            if ($stmt->affected_rows == 0)
                return null;
            $role = new UserRole();
            $stmt->bind_result($role->id, $role->code, $role->name);
            if ($stmt->fetch())
                return $role;
            return null;
        });
    }
}