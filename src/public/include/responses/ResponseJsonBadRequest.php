<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 3:36 PM
 */

namespace responses;

require_once __DIR__.'/ResponseJson.php';

class ResponseJsonBadRequest implements ResponseJson
{

    /**
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param $code
     * @return \Slim\Http\Response
     */
    public static function responseBadRequest(\Slim\Http\Request $request, \Slim\Http\Response $response, $code){
        switch ($code){
            case 40001:  return self::responseInvalidToken($request, $response);
            case 40403: return self::responseNotFoundFonda($request, $response);
            default: return null;


        }

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
            CODE => $this->getStatus(),
            MESSAGE => $this->getMsg()
        ];
        if ($this->getDetail() != null)
        {
            $rt[REASON] = $this->getDetail();
        }
        return $rt;
    }


    private static function responseInvalidToken(\Slim\Http\Request $request, \Slim\Http\Response $response){
        return ResponseBuilder::build(
            new \responses\ResponseJsonBadRequest('Token is invalid or user not found', 40001),
            $response, $request, 400
        );
    }

    private static function responseNotFoundFonda(\Slim\Http\Request $request, \Slim\Http\Response $response){
        return ResponseBuilder::build(
            new \responses\ResponseJsonBadRequest('Fonda not found', 40403),
            $response, $request, 400
        );
    }
}