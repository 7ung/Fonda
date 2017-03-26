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

    private $user;

    function __construct($_username, $_password, $_email = '')
    {
        parent::__construct();
        $this->hash($_username, $_password);
        $this->user = new User($_username, $_password, $_email);

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
    public function checkExistsUsername()
    {
        $stmt = $this->prepare(mysql_queries_1[SELECT_USERNAME],"s", $this->user->getUsername());
        return $this->execute($stmt, function () use ($stmt)
        {
            if ($stmt->fetch() == 0)
                return false;
            else
                return true;
        });
    }

    public function checkExistsEmail()
    {
        $stmt = $this->prepare(mysql_queries_1[SELECT_USER_EMAIL], "s", $this->user->getEmail());
        return $this->execute($stmt, function () use ($stmt)
        {
            if ($stmt->fetch() == 0)
                return false;
            else
                return true;
        });
    }

    /**
     * @return ../entities/User mixed
     */
    public function createUser()
    {
        //$this->refresh();
        $stmt = $this->prepare(mysql_queries_3[CREATE_USER], "sss",
            $this->user->getUsername(),
            $this->user->getTemporaryPassword(),
            $this->user->getEmail());
        return $this->execute($stmt, function() use ($stmt)
        {
            //$stmt->close();
            $this->user->setId($this->lastInsertId());
            return $this->user;
        });

    }

    private function hash(&$username, &$password)
    {
        //hashing password and username
        $password = \common\strong_hashing($password);
        $username = \common\quick_hashing($username);
    }

    public function login()
    {
        $stmt = $this->prepare(mysql_queries_2[LOGIN_ACCOUNT], "ss",
            'QoG8fvo81l/s6pAsaOij/',
            '$2y$10$AiaIOQGXi/RR/1/7509JKuDwGHJHgXzo20ZVwO5WSg9zHW2XMpZSO');
        return $this->execute($stmt, function() use ($stmt)
        {
            $rs = -1;
            $stmt->bind_result($rs);
            $stmt->fetch();
            /*
             * rs = 1 nếu login thành công
             * rs = 0 nếu login fail
             */
            return $rs;
        });
    }

    public function updatePassword($newPassword)
    {
        $this->user->temporaryPassword = \common\strong_hashing($newPassword);
        $stmt = $this->prepare(mysql_queries_3[UPDATE_USER_USERNAME_PASSWORD], 'sss',
            $this->user->temporaryPassword,
            $this->user->username,
            $this->user->email);
        return $this->execute($stmt, function () use ($stmt)
        {
            if ($stmt->affected_rows == 0)
                return 0;
            else
                return 1;
        });
    }


}