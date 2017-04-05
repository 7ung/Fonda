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

    private $userId;

    private $username;

    private $password;

    function __construct($_username, $_password)
    {
        parent::__construct();
        $this->username = \common\quick_hashing($_username);
        $this->password = $_password;
    }

    /**
     * get access token for log in feature
     * @return mixed
     * @throws InvalidArgumentException
     * @throws MySqlExecuteFailException
     */
    public function getAccessToken()
    {
        //$token;
        $user = $this->findUserByUsername();

        if ($user == null)
            throw new InvalidArgumentException('User name or password wrong', 401);

//        if ($this->isActive($token->user->id) == false)
//            throw new InvalidArgumentException('', 401); // todo

        /* username correct => check password*/
        $correct = \common\verify_string($this->password, $user->temporaryPassword);

        if ($correct === false){
            /* password incorrect => throw exception*/
            throw new InvalidArgumentException('User name or password wrong', 401);

        }
        else{


            /* password correct => create token => if token exists, update, if not, create new*/
            $token->id = $this->createToken($token->user->id);

            /* if token creation fail throw exception */
            if ($token->id == 0)
                throw new MySqlExecuteFailException('Can not create token', 400);

            /* if token creation success, get token info*/
            return $this->findTokenById($token);

        }

    }

//    /**
//     * @return mixed tamparate token
//     */
//    public function findUserByUsername()
//    {
//        $stmt = $this->prepare(User::$queries['findByUsername'], 's', $this->username);
//        return $this->execute($stmt, function () use ($stmt)
//        {
////            $token = new Token();
//            $user = new User();
//            $stmt->bind_result($user->id, $user->username, $user->temporaryPassword,
//                $user->email, $user->userRoleId, $user->createdDate);
//
//            if ($stmt->fetch())
//                return $user;
//            return null;
//        });
//    }

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

        });
    }

    /**
     * @param Token $token origin token info
     * @return mixed retrieved token info
     */
    public function findTokenById(Token &$token)
    {
        $stmt = $this->prepare(mysql_queries_1[SELECT_ACCESS_TOKEN_ID], "i",
            $token->id);
        return $this->execute($stmt, function() use ($stmt, &$token)
        {
            if ($stmt->affected_rows == 0)
                throw new MySqlExecuteFailException('Token info not found. Check token id', 500);
            $stmt->bind_result($token->id, $token->userId, $token->token, $token->expired);
            if ($stmt->fetch())
                return $token;
            else
                return null;
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