<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 7:56 PM
 */

namespace fonda\controller;


use function common\generateToken;
use function common\quick_hashing;
use function common\randString;
use common\SimpleMailSender;
use function common\verify_quick_hash;
use model\VerifyMember;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'Controller.php';

/**
 * Class TestController: Test every thing here
 * @package fonda\controller
 */
class TestController extends Controller
{

    function getMethod()
    {
        return [PUT];
    }

    function getUrl()
    {
        return '/test/{id}';
    }

    function exec(Request $request, Response $response)
    {
        echo $_SERVER['REQUEST_TIME']; echo '<br/>';
        echo $request->getParam('a'); echo '<br/>';
        echo $request->getAttribute('id');
        //echo generateToken(67);
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

