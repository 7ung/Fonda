<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 1:42 PM
 */

namespace entities;

class User
{
    private $id;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getTemporaryPassword()
    {
        return $this->temporaryPassword;
    }

    /**
     * @param string $temporaryPassword
     */
    public function setTemporaryPassword($temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param null $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

}