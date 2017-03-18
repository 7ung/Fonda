<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 1:42 PM
 */

namespace model;


class User
{
    private $username;

    private $temporaryPassword;

    private $email;

    private $createdDate;

    function __construct($_username= '', $_password = '', $_email = '', $_createDate = null)
    {
        $this->username = $_username;
        $this->temporaryPassword = $_password;
        $this->email = $_email;
        $this->createdDate = $_createDate;

    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getTemporaryPassword()
    {
        return $this->temporaryPassword;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
}