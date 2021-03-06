<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/24/2017
 * Time: 10:36 PM
 */

namespace Exceptions;



use Responses\ResponseJsonError;

require_once __DIR__.'/../Responses/_loader.php';

class InvalidArgumentException extends ResponseJsonError
{
    private $error;

    function __construct($errorDetail, $code)
    {
        parent::__construct('Invalid requested params', $code);
        $this->error = $errorDetail;
    }

    function getDetail()
    {
        return $this->error;
    }
}