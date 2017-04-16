<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:36 PM
 */

namespace Responses;

use Illuminate\Support\Facades\Response;

require_once __DIR__.'/ResponseJson.php';

class ResponseJsonBadRequest implements ResponseJson
{

    public static $errosMessage = [
        // BAD REQUEST
        40001 => 'Username must not empty',
        40002 => 'Email must not empty',
        40003 => 'Password must not empty',
        40004 => 'Verify Code must not empty',
        40005 => 'Longitude must not empty',
        40006 => 'Latitude must not empty',
        40007 => 'Image must not empty',
        40008 => 'Image wrong format',
        40010 => 'Fonda name must not empty',
        40011 => 'Fonda group id must not empty',
        40012 => 'Scale must not empty',
        40013 => 'Scale value wrong',
        40014 => 'Wrong time format',
        40015 => 'Location format is wrong',
        40016 => 'Day of week format is wrong',
        40017 => 'Active param only 0 or 1',
        40018 => 'Group name must not empty',
        40019 => 'Utility name must not empty',
        40020 => 'Culinary name must not empty',
        40021 => 'Culinary id must not empty',
        40024 => 'Wrong date format',
        40025 => 'Utility id must not empty',
        40026 => 'Comment content must not empty',
        40027 => 'Fonda id must not empty',
        // UNAUTHORIZED
        40101 => 'Username or password wrong',
        40102 => 'Account has not active',
        // FORBIDDEN
        40300 => 'Invalid token or user not found',
        40301 => 'User role must be VENDOR',
        40311 => 'User has not permission',
        // NOT FOUND
        40401 => 'Username not found',
        40402 => 'Wrong email',
        40403 => 'Fonda not found',
        40404 => 'User not found',
        40405 => 'Location not found',
        40406 => 'Image not found',
        40410 => 'Fonda not found',
        40411 => 'Fonda group not found',
        40412 => 'Fonda image not found',
        40413 => 'Sale info fot found',
        40415 => 'Utility not found',
        40420 => 'Culinary not found',
        40426 => 'Comment fond found',
        // CONFLICT
        40901 => 'Username exists',
        40902 => 'User\'s email exists',
        40903 => 'Account has actived',
        40905 => 'Location not belongs to user',
        40906 => 'Image not belongs to user',
        40907 => 'Can not delete profile piture',
        40912 => 'Image not belongs to fonda',
        40913 => 'Can not create sale too much',
        40914 => 'Close time must be greater than open time',
        40915 => 'Cannot create too much fonda\'s utilities',
        40916 => 'Cannot insert exists fonda\'s utilities',
        40920 => 'Cannot create too much fonda\'s culinary',
        40921 => 'Cannot insert exists fonda\'s culinary',
        40924 => 'End day must be greater than begin day'

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