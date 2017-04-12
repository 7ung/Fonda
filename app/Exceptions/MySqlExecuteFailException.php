<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 2:40 PM
 */

namespace Exceptions;


use responses\ResponseJsonError;

require_once __DIR__.'/../Responses/_loader.php';

class MySqlExecuteFailException extends ResponseJsonError
{
    private $error;

    function __construct($errorDetail)
    {
        parent::__construct('MySQL query cannot be executed');
        $this->error = $errorDetail;
    }

    function getDetail()
    {
        return $this->error;
    }
}