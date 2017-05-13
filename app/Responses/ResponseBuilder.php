<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 2:28 PM
 */

namespace Responses;


use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;

require_once 'ResponseJson.php';

class ResponseBuilder
{
    /**
     * @param \responses\ResponseJson $data
     * @param Response $response
     * @param Request|null $request
     * @param int $statusCode
     * @return Response
     */
//    static function build(ResponseJson $data, Response $response,
//                          Request $request = null, $statusCode = 200)
//    {
//        $responseJsonArray = array();
//        $responseJsonArray[VER] = API_VERSION;
//        $responseJsonArray[STATUS] = $statusCode;
//        $responseJsonArray[METHOD] = static::getRoute($request);
//
//        if ( $data === null || $data->serializableArray() == null)
//            return $response->withJson($responseJsonArray, $statusCode);
//
//        if ($data instanceof ResponseJsonData){
//            $name = $data->name();
//            $responseJsonArray[$name] = $data->serializableArray()[$name];
//        } else if ($data instanceof ResponseJsonError ) {
//            $responseJsonArray[ERROR] = $data->serializableArray();
//        } else if ($data instanceof ResponseJsonBadRequest){
//            $responseJsonArray[ERROR] = $data->serializableArray();
//        }
//        return $response->withJson($responseJsonArray, $statusCode);
//
//    }

    static $API_VERSION = '1.0';

    static function build( $data, $statusCode = 200, $message = '')
    {
        $responseJsonArray = array();
        $responseJsonArray['ver'] = self::$API_VERSION;
        $responseJsonArray['status'] = $statusCode;
        $responseJsonArray['method'] = self::getRoute();

        if (empty($message) == false)
            $responseJsonArray['message'] = $message;

        if ( $data === null)
            return $responseJsonArray;

        if ($data instanceof Model){
//            $responseJsonArray[$data->jsonName] = $data;
            $responseJsonArray["data"] = $data;
        } else if (is_array($data) && empty($data) == false) {
            $responseJsonArray['collections'] = $data;
        } else if ($data instanceof ResponseJsonError ) {
            $responseJsonArray['error'] = $data->serializableArray();
        } else if ($data instanceof ResponseJsonBadRequest){
            $responseJsonArray['error'] = $data->serializableArray();
        }
        return $responseJsonArray;

    }

    private static function getRoute()
    {
        return \Illuminate\Support\Facades\Route::current()->uri().'.'.\Illuminate\Support\Facades\Request::method();
    }
}