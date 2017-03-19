<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 2:28 PM
 */

namespace common;


use interfaces\ResponseJson;
use interfaces\ResponseJsonBadRequest;
use interfaces\ResponseJsonData;
use interfaces\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__ . '/../constant.php';

class ResponseBuilder
{
    static function build(ResponseJson $data, Response $response,
                        Request $request = null, $statusCode = 200)
    {
        $responseJsonArray = array();
        $responseJsonArray[VER] = API_VERSION;
        $responseJsonArray[STATUS] = $statusCode;
        $responseJsonArray[METHOD] = static::getRoute($request);

        if ( $data->serializableArray() == null)
            return $response->withJson($responseJsonArray, $statusCode);

        if ($data instanceof ResponseJsonData){
            $responseJsonArray[DATA] = $data->serializableArray();
        } else if ($data instanceof ResponseJsonError ) {
            $responseJsonArray[ERROR] = $data->serializableArray();
        } else if ($data instanceof ResponseJsonBadRequest){
            $responseJsonArray[ERROR] = $data->serializableArray();
        }
        return $response->withJson($responseJsonArray, $statusCode);

    }

    private static function getRoute(Request $request)
    {
        if ($request == null){
            return null;
        } else {
            return $request->getRequestTarget().'.'.$request->getMethod();
        }
    }
}