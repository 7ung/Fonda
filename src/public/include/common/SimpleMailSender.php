<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/19/2017
 * Time: 8:16 PM
 */

namespace common;

require_once __DIR__.'/../../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require_once __DIR__.'/../config.php';
require_once __DIR__.'/mail_template.php';

class SimpleMailSender
{
    private $mail;

    function __construct()
    {
        $this->mail = new \PHPMailerOAuth();
        $this->mail->isSMTP();
        $this->mail->AuthType = MAIL_AUTH_TYPE;
        $this->mail->oauthUserEmail = OAUTH_USER_EMAIL;
        $this->mail->oauthClientId = OAUTH_CLIENT_ID;
        $this->mail->oauthClientSecret = OAUTH_CLIENT_SECRET;
        $this->mail->oauthRefreshToken = OAUTH_REFRESH_TOKEN;

        $this->mail->Host = MAIL_HOST;
        $this->mail->Port = MAIL_PORT;
        $this->mail->SMTPSecure = MAIL_SMTP_SUCURE;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = MAIL_SEND_FROM;
        $this->mail->Password = MAIL_SENDER_PASSWORD;

        $this->mail->setFrom(MAIL_SEND_FROM, MAIL_SENDER_NAME);
        $this->mail->CharSet = 'UTF-8';
    }

    function sendEmail($receiver, $subject, $body)
    {
        $this->mail->addAddress($receiver);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        return $this->mail->send();
    }
}