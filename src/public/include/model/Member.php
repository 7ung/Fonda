<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 7:27 PM
 */

namespace model;


use exception\MySqlExecuteFailException;
use fonda\db\Connection;

require_once __DIR__.'/queries.php';
require_once __DIR__.'/../exception/MySqlExecuteFailException.php';
require_once __DIR__.'/../entities/User.php';
require_once __DIR__.'/../db/Connection.php';

class Member
{

    private $user;

    private $connection;

    function __construct($_username, $_password, $_email)
    {
        $this->hash($_username, $_password);
        $this->user = new User($_username, $_password, $_email);
        $this->connection = (new Connection())->connect();

    }

    function __destruct()
    {
        $this->connection->close();
    }

    /**
     * @param $user username going to be use for register
     * @param $email email going to be use for register
     * @return true if exists user, false if not exists user
     * @throws: if execute fail
     */
    public function checkExistsUsername()
    {
        $stmt = $this->connection->prepare(mysql_queries_1[SELECT_USERNAME]);
        $stmt->bind_param("s", $this->user->getUsername());

        $rs = true;
        if ($stmt->execute() == 0)
        {
            // execute fail
            $error_msg = $stmt->error;
            $stmt->close();
            throw new MySqlExecuteFailException($error_msg);
        }
        else
        {
            if ($stmt->fetch() == 0)
                $rs = false;
            else
                $rs = true;
        }
        $stmt->close();
        return $rs;
    }

    public function checkExistsEmail()
    {
        $stmt = $this->connection->prepare(mysql_queries_1[SELECT_USER_EMAIL]);
        $stmt->bind_param("s", $this->user->getEmail());

        $rs = true;
        if ($stmt->execute() == 0)
        {
            // execute fail
            $error_msg = $stmt->error;
            $stmt->close();
            throw new MySqlExecuteFailException($error_msg);
        }
        else
        {
            if ($stmt->fetch() == 0)
                $rs = false;
            else
                $rs = true;
        }
        $stmt->close();
        return $rs;
    }


    /**
     * @param $username
     * @param $pass
     * @param $email
     * @return integer: id of created user
     * @throws MySqlExecuteFailException: throw if execute fail
     */
    public function createUser()
    {
        $stmt = $this->connection->prepare(mysql_queries_3[CREATE_USER]);
        $stmt->bind_param("sss",
            $this->user->getUsername(),
            $this->user->getTemporaryPassword(),
            $this->user->getEmail());

        if ($stmt->execute() == 0)
        {
            // execute error
            $error_msg = $stmt->error;
            $stmt->close();
            throw new MySqlExecuteFailException($error_msg);
        }
        else
        {
            // todo: send email verify
            $lastId = $this->connection->insert_id;
            $stmt->close();
            return $lastId;
        }
    }

    private function hash(&$username, &$password)
    {
        //hashing password and username
        $password = \common\strong_hashing($password);
        $username = \common\quick_hashing($username);
    }
}