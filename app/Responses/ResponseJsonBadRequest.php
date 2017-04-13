<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:36 PM
 */

namespace Responses;

require_once __DIR__.'/ResponseJson.php';

class ResponseJsonBadRequest implements ResponseJson
{

    public static $errosMessage = [
        40001 => 'Username must not empty',
        40002 => 'Email must not empty',
        40003 => 'Password must not empty',
        40004 => 'Verify Code must not empty',
        40005 => 'Longitude must not empty',
        40006 => 'Latitude must not empty',
        40007 => 'Image must not empty',
        40101 => 'Username or password wrong',
        40102 => 'Account has not active',
        40300 => 'Invalid token or user not found',
        40401 => 'Username not found',
        40402 => 'Wrong email',
        40403 => 'Fonda not found',
        40404 => 'User not found',
        40405 => 'Location not found',
        40406 => 'Image not found',
        40901 => 'Username exists',
        40902 => 'User\'s email exists',
        40903 => 'Account has actived',
        40905 => 'Location not belongs to user',
        40906 => 'Image not belongs to user',

    ];
//    /**
//     * @param \Slim\Http\Request $request
//     * @param \Slim\Http\Response $response
//     * @param $code
//     * @return \Slim\Http\Response
//     */
//    public static function responseBadRequest(\Slim\Http\Request $request, \Slim\Http\Response $response, $code){
//        return ResponseBuilder::build(
//            new ResponseJsonBadRequest(self::$errosMessage[$code], $code),
//            $response, $request, 400
//        );
//    }

    public static function responseBadRequest($code)
    {
        return ResponseBuilder::build(
            new ResponseJsonBadRequest(self::$errosMessage[$code], $code),
            400
        );
    }

    private $msg;

    private $status;

    private $detail;

    function __construct($message = 'Bad Request', $code = 400, $detail = '')
    {
        $this->msg = $message;
        $this->status = $code;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    function getDetail()
    {
        return $this->detail;
    }

    function serializableArray()
    {
        $rt = [
            'code' => $this->getStatus(),
            'message' => $this->getMsg()
        ];
        if ($this->getDetail() != null)
        {
            $rt['reason'] = $this->getDetail();
        }
        return $rt;
    }


}