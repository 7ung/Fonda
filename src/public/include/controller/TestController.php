<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 7:56 PM
 */

namespace fonda\controller;


use function common\quick_hashing;
use function common\verify_quick_hash;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../common/hashing.php';

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
        echo $_SERVER['DOCUMENT_ROOT'];
    }

    private function sendMail()
    {

        require __DIR__.'/../../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
        $mail = new \PHPMailerOAuth();
        $mail->isSMTP();
        $mail->AuthType = 'XOAUTH2';
        $mail->oauthUserEmail = "fondateam.uit@gmail.com";
        $mail->oauthClientId = '894327853122-con1n670jvdbtl5k17i7k2omcm88h08k.apps.googleusercontent.com';
        $mail->oauthClientSecret = 'FjopiT3jRW2_VAX96YA9mV9d';
        $mail->oauthRefreshToken = '1/c8iVF1IoOw5UX9k6u2ySLu3XvhfIJQsV9h6O3zzxd9gfOFaYnLnyRGnZuURqgjk5';

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "fondateam.uit@gmail.com";
        $mail->Password = "13521005";

        $mail->setFrom('fondateam.uit@gmail.com', 'Fonda Team');
        $mail->addAddress('13521005@gm.uit.edu.vn');
        $mail->Subject = 'PHPMailer GMail SMTP test ú ni cót';
        $mail->CharSet = 'UTF-8';
        //$mail->AltBody = 'This is a plain-text message body';
        $mail->addAttachment(__DIR__.'/../../../vendor/phpmailer/phpmailer/examples/images/phpmailer_mini.png');
        $mail->Body = "hello my friend  <b> ahihi đồ ngốc </b>";
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
        echo '<br/>';
        echo (new \DateTime())->format('h:i:sa');
    }
}