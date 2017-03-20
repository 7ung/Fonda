<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 7:56 PM
 */

namespace fonda\controller;


use function common\quick_hashing;
use common\SimpleMailSender;
use function common\verify_quick_hash;
use model\VerifyMember;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../common/hashing.php';
require_once __DIR__.'/../model/VerifyMember.php';
require_once __DIR__.'/../common/SimpleMailSender.php';

/**
 * Class TestController: Test every thing here
 * @package fonda\controller
 */
class TestController implements Controller
{

    function getMethod()
    {
        return [GET];
    }

    function getUrl()
    {
        return '/test';
    }

    function exec(Request $request, Response $response)
    {
        $mailSender = new SimpleMailSender();
//        $body = mail_template['verify_code_required'][MAIL_BODY];
//        if ($mailSender->sendEmail('hohoangtung12a3@gmail.com',
//            mail_template['verify_code_required'][MAIL_SUBJECT],
//            ))
//        {
//            echo 'success';
//        }
//        else
//            echo 'fail';
    }


}

