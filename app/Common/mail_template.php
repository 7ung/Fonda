<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/20/2017
 * Time: 9:37 PM
 */


if (!defined('MAIL_SUBJECT'))
    define('MAIL_SUBJECT', 'mail_subject');
if (!defined('MAIL_BODY'))
    define('MAIL_BODY', 'mail_body');

const mail_template =
    [
        'verify_code_required' =>
            [
                MAIL_SUBJECT    => 'Eatio - Verify your account',
                MAIL_BODY       => 'Your code: {?}'
            ],
        'resend_password' =>
            [
                MAIL_SUBJECT    => 'Eatio- Renew password account',
                MAIL_BODY       => 'Your password {?}'
            ]
    ];
