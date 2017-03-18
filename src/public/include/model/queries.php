<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/18/2017
 * Time: 8:27 PM
 */

define ('SELECT_USERNAME', 'query_select_username');
define ('CREATE_USER', 'query_create_user');
define ('SELECT_USER_EMAIL', 'query_select_user_email');

/**
 * List queries has 1 parameter.
 */
const mysql_queries_1 =
    [
        /**
         *
         */
        SELECT_USERNAME => 'select id from user WHERE username =?',

        /**
         *
         */
        SELECT_USER_EMAIL => 'select id from user WHERE email =?'
    ];


/**
 * List queries has 3 parameters.
 */
const mysql_queries_3 =
[
    /**
     *
     */
    CREATE_USER =>  'call foodee.insert_user(?, ?, ?)'
];