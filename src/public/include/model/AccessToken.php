<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 12:22 AM
 */

namespace model;


use function common\generateToken;
use entities\Token;
use entities\User;
use exception\InvalidArgumentException;
use exception\MySqlExecuteFailException;

require_once 'BaseModel.php';

class AccessToken extends BaseModel
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * If token is created, update this token, if not, create new token
     * @param $userId
     * @return mixed inserted id
     */
    public function createToken($userId)
    {
        $tokenString = generateToken($userId);
        $stmt = $this->prepare(Token::$queries['create'], "sii",
            $tokenString,
            -1,
            $userId); // -1 meaning none
        return $this->execute($stmt, function() use ($stmt, $userId)
        {
//            if ($stmt->affected_rows == 0)
//                throw new MySqlExecuteFailException('Something wrong, can not create token, check user id = '.$userId);
            return true;
        });
    }

    /**
     * return token found by user id, return null if not found.
     * @param $userId
     * @return mixed
     */
    public function findTokenByUserId($userId )
    {
        $stmt = $this->prepare(Token::$queries['findByUserId'], 'i', $userId);

        return $this->execute($stmt, function () use ($stmt)
        {
           if ($stmt->affected_rows == 0)
               return null;
           $token = new Token();
           $stmt->bind_result($token->id, $token->token, $token->expired, $token->userId);
           if ($stmt->fetch())
               return $token;
           return null;
        });
    }

}