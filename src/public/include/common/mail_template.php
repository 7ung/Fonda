<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/20/2017
 * Time: 9:37 PM
 */

require_once __DIR__.'/../config.php';

if (!defined('MAIL_SUBJECT'))
    define('MAIL_SUBJECT', 'mail_subject');
if (!defined('MAIL_BODY'))
    define('MAIL_BODY', 'mail_body');

const mail_template =
    [
        'verify_code_required' =>
            [
                MAIL_SUBJECT    => APP_NAME.' - Verify your account',
                MAIL_BODY       => 'Your code: {?}'
            ]

    ];
