<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/20/2017
 * Time: 8:33 AM
 */

namespace model;

use entities\VerifyStatus;
use exception\InvalidArgumentException;
use mysqli_stmt;

require_once __DIR__.'/BaseModel.php';

class VerifyMember extends BaseModel
{
    private $verifyStatus;

    function __construct($_userId, $_verifyCode = null)
    {
        parent::__construct();
        $this->verifyStatus = new VerifyStatus();
        $this->verifyStatus->userId = $_userId;
        $this->verifyStatus->code = $_verifyCode;
    }

    function __destruct()
    {
        parent::__destruct();
    }

    function createVerifyCode()
    {
        // setup
        $this->verifyStatus->code = (string)random_int(111111, 999999);
        $date = strtotime('+3 days', (new \DateTime())->getTimestamp());
        $this->verifyStatus->expired = $date;

        // insert
        $stmt = $this->prepare(mysql_queries_3[CREATE_VERIFY_CODE], 'iss',
            $this->verifyStatus->userId,
            $this->verifyStatus->code,
            $this->verifyStatus->expired);
        $lastId = $this->execute($stmt, function()
        {
            return $this->getConnection()->insert_id;
        });

        // select by last inserted id
        $this->verifyStatus = $this->getVerifyStatusById($lastId);

        // return selected value
        return $this->verifyStatus;
    }

    function getVerifyStatusById($id)
    {
        $stmt = $this->prepare(mysql_queries_1[SELECT_VERIFY_STATUS_ID], 'i', $id);

        return  $this->execute($stmt, function() use ($stmt)
        {
            $_verifyStatus = new VerifyStatus();
            $stmt->bind_result(
                $_verifyStatus->id,
                $_verifyStatus->userId,
                $_verifyStatus->code,
                $_verifyStatus->expired,
                $_verifyStatus->triedTime,
                $_verifyStatus->status);
            while($stmt->fetch())
            {
                return $_verifyStatus;
            }
            return null;
        });
    }

    /**
     * @param $userId
     * @return mixed
     */
    function findVerifyStatusByUserId($userId)
    {
        $stmt = $this->prepare(mysql_queries_1[SELECT_VERIFY_STATUS_USERID], 'i', $userId);

        return  $this->execute($stmt, function() use ($stmt)
        {
            if ($stmt->affected_rows == 0)
                return null;
            $_verifyStatus = new VerifyStatus();
            $stmt->bind_result(
                $_verifyStatus->id,
                $_verifyStatus->userId,
                $_verifyStatus->code,
                $_verifyStatus->expired,
                $_verifyStatus->triedTime,
                $_verifyStatus->status);
            while($stmt->fetch())
            {
                return $_verifyStatus;
            }
            return null;
        });
    }

    public function save(VerifyStatus $verifyStatus)
    {
        $stmt = $this->prepare(VerifyStatus::$queries['save']);
        $stmt->bind_param('siiii', $verifyStatus->code, $verifyStatus->expired,
            $verifyStatus->triedTime, $verifyStatus->status, $verifyStatus->id);
        return $this->execute($stmt, function(){
             return null;
        });
    }

    /* input: userid, code,
     * findVerifyStatusByUserId
     *
     * */
}