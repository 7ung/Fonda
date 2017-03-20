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
define('CREATE_VERIFY_CODE', 'query_create_verify_code');
define('SELECT_VERIFY_STATUS_ID', 'query_select_verify_status_id');

define('LAST_INSERT_ID', 'last_insert_id');
/**
 *
 */

const mysql_queries =[
        LAST_INSERT_ID => 'select last_insert_id()'
    ];

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
        SELECT_USER_EMAIL => 'select id from user WHERE email =?',

        /**
         *
         */
        SELECT_VERIFY_STATUS_ID => 'select id, user_id, expired, tried_time, status from verify_status where(id = ?)'
    ];


/**
 * List queries has 3 parameters.
 */
const mysql_queries_3 =
[
    /**
     *
     */
    CREATE_USER =>  'call foodee.insert_user(?, ?, ?)',

    /**
     *
     */
    CREATE_VERIFY_CODE => 'insert into verify_status(user_id, code, expired) values(?, ?, ?)'
];