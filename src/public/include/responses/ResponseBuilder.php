<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 2:28 PM
 */

namespace responses;


use responses\ResponseJson;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonData;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

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
    static function build(ResponseJson $data, Response $response,
                          Request $request = null, $statusCode = 200)
    {
        $responseJsonArray = array();
        $responseJsonArray[VER] = API_VERSION;
        $responseJsonArray[STATUS] = $statusCode;
        $responseJsonArray[METHOD] = static::getRoute($request);

        if ( $data === null || $data->serializableArray() == null)
            return $response->withJson($responseJsonArray, $statusCode);

        if ($data instanceof ResponseJsonData){
            $name = $data->name();
            $responseJsonArray[$name] = $data->serializableArray()[$name];
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