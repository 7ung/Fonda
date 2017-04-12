<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 10:07 PM
 */

namespace Exceptions;


use responses\ResponseJsonError;

class MailSenderException extends ResponseJsonError
{
    private $error;

    function __construct($errorDetail, $code)
    {
        parent::__construct('Some thing wrong with mail sender', $code);
        $this->error = $errorDetail;
    }

    function getDetail()
    {
        return $this->error;
    }
}