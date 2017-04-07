<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 1:42 PM
 */

namespace entities;

use model\BaseModel;
use responses\ResponseJsonData;

class User extends ResponseJsonData
{
    /**
     * Account for test:
     * username: tunghh
     * password 123456
     * DO NOT delete this user
     */

    public $id = 0;

    public $username = '';

    public $temporaryPassword = '';

    public $email = '';

    public $userRoleId = 0;

    public $createdDate = 0;

    public $userRole = null;

    public static $queries = [
        'insert' => 'insert into user(username, password, email, created_date) values(?, ?, ?, ?)',
        'findByUsername' => 'select id, username, password, email, user_role_id, created_date from user where (username = ?)',
        'findByEmail' => 'select id, username, password, email, user_role_id, created_date from user where (email = ?)',
        'findById' => 'select id, username, password, email, user_role_id, created_date from user where (id = ?)',
        'save' => 'update user set password = ?, email = ?, user_role_id = ? where id = ?'
    ];

    function serializableArray()
    {
        $_n = $this->name();
        $rs = array(
            $_n => array()
        );
        if ($this->id !== 0)
            $rs[$_n]['id'] = $this->id;
     //   if ($this->username !== '')
     //       $rs['user']['username'] = $this->username;
        if ($this->email !== '')
            $rs[$_n]['email'] = $this->email;
        if ($this->userRoleId !== 0 )
            $rs[$_n]['user_role_id'] = $this->userRoleId;
        if ($this->userRole !== null)
            $rs[$_n]['user_role'] = $this->userRole->serializableArray()['user_role'];
        return $rs;

    }

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

    function name()
    {
        return 'user';
    }
}