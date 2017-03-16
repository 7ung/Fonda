<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/16/2017
 * Time: 10:22 AM
 */

namespace fonda\controller;

use fonda\db\Connection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__.'/Controller.php';
require __DIR__.'/../db/Connection.php';

class RegisterController implements Controller
{

    function getMethod(){
        return [POST];
    }

    function getUrl() {
        return "/register";
    }

    private $connection;
    private $stmt;

    private static $query_select_username = "select id from user WHERE username =? or email =?";
    private static $query_create_user = "insert into user(username, password, email) values (?, ?, ?)";

    function exec(ServerRequestInterface $request, ResponseInterface $response)
    {
        $username = $request->getParsedBody()['username'];
        $password = $request->getParsedBody()['password'];
        $email = $request->getParsedBody()['email'];

        //$this->connection = (new Connection())->connect();
        if ($this->checkExistsUser($username, $email) == true)
        {
            // exists user. not allow to register
        }
        else
        {
            // not exists user. allow to register
            if ($this->createUser($username, $password, $email) == true)
            {

            }
            else
            {

            }

        }
    }

    /**
     * @param $user username going to be use for register
     * @param $email email going to be use for register
     * @return true if exists user, false if not exists user
     * @throws: if execute fail
     */
    private function checkExistsUser($user, $email)
    {
        $this->connection = (new Connection())->connect();
        $this->stmt = $this->connection->prepare(RegisterController::$query_select_username);
        $this->stmt->bind_param("ss", $user, $email);
        $rs = true;
        if ($this->stmt->execute() == 0)
        {
            // execute error
            // todo: execute error message
            $this->stmt->close();
            throw new \Exception("execute error");
        }
        else
        {
            if ($this->stmt->num_rows == 0)
                $rs = false;
            else
                $rs = true;
        }
        $this->stmt->close();
        return $rs;
    }

    /**
     * @param $username
     * @param $pass
     * @param $email
     * @return bool: true if create successfully
     */
    private function createUser($username, $pass, $email)
    {
        $this->connection = (new Connection())->connect();
        $this->stmt = $this->connection->prepare(RegisterController::$query_create_user);
        $this->stmt->bind_param("sss", $username, $pass, $email);

        if ($this->stmt->execute() == 0)
        {
            // execute error
            // todo: execute error message
            $this->stmt->close();
            return false;
        }
        else
        {
            // todo: ecrypt password
            // todo: send email verify
            $this->stmt->close();
            return true;
        }

    }
}