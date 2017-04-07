<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 7:27 PM
 */

namespace model;


use function common\generateToken;
use entities\User;
use exception\MySqlExecuteFailException;
use fonda\db\Connection;

require_once __DIR__.'/BaseModel.php';

class Member extends BaseModel
{

    function __construct()
    {
        parent::__construct();

    }

    function __destruct()
    {
        parent::__construct();
    }

    /**
     * @param $user username going to be use for register
     * @param $email email going to be use for register
     * @return true if exists user, false if not exists user
     * @throws: if execute fail
     */
    public function isExistsByUsername($username)
    {
        return $this->findUserByUsername($username) != null;
    }

    public function isExistsByEmail($email)
    {
        return $this->findUserByEmail($email) != null;
    }

    /**
     * @return ../entities/User mixed
     */
    public function createUser($username, $password, $email)
    {
        $username = \common\quick_hashing($username);
        $password = \common\strong_hashing($password);
        //$this->refresh();
        $stmt = $this->getConnection()->prepare(User::$queries['insert']);
        $stmt->bind_param('sssi',
            $username,
            $password,
            $email,
            $_SERVER['REQUEST_TIME']);

        return $this->execute($stmt, function() use ($stmt)
        {
            return true;
        });

    }


    public function findUserByUsername($username)
    {
        $username = \common\quick_hashing($username);

        $stmt = $this->prepare(User::$queries['findByUsername'], 's', $username);
        return $this->execute($stmt, function () use ($stmt)
        {
//            $token = new Token();
            $user = new User();
            $stmt->bind_result($user->id, $user->username, $user->temporaryPassword,
                $user->email, $user->userRoleId, $user->createdDate);

            if ($stmt->fetch())
                return $user;
            return null;
        });
    }

    public function findUserByEmail($email){
        $stmt = $this->prepare(User::$queries['findByEmail'], 's', $email);
        return $this->execute($stmt, function () use ($stmt)
        {
            $user = new User();
            $stmt->bind_result($user->id, $user->username, $user->temporaryPassword,
                $user->email, $user->userRoleId, $user->createdDate);

            if ($stmt->fetch())
                return $user;
            return null;
        });
    }

    /**
     * @param $userId
     * @return User
     */
    public function findUserById($userId){
        $stmt = $this->prepare(User::$queries['findById'], 's', $userId);
        return $this->execute($stmt, function () use ($stmt)
        {
            $user = new User();
            $stmt->bind_result($user->id, $user->username, $user->temporaryPassword,
                $user->email, $user->userRoleId, $user->createdDate);

            if ($stmt->fetch())
                return $user;
            return null;
        });
    }

    public function save(User $user)
    {
        $stmt = $this->prepare(User::$queries['save']);
        $stmt->bind_param('ssii', $user->temporaryPassword, $user->email,
            $user->userRoleId, $user->id);
        return $this->execute($stmt, function(){
            return true;
        });
    }



}