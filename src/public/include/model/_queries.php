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
define('SELECT_VERIFY_STATUS_USERID', 'query_select_verify_status_userid');
define('VERIFY_ACCOUNT', 'query_verify_account');
define('LAST_INSERT_ID', 'last_insert_id');
define('LOGIN_ACCOUNT', 'query_login_account');
define('CREATE_ACCESS_TOKEN', 'query_create_access_token');
define('SELECT_ACCESS_TOKEN_USERID', 'query_select_access_token_userid');
define('GET_ACCOUNT_INFO', 'query_get_account_info');
define('UPDATE_USER_USERNAME_PASSWORD', 'query_update_user_username_password');

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
        SELECT_VERIFY_STATUS_ID => 'select id, user_id, code, expired, tried_time, status from verify_status where(id = ?)',

        /**
         *
         */
        SELECT_VERIFY_STATUS_USERID => 'select id, user_id, code, expired, tried_time, status from verify_status where(user_id = ?)',

        /*
         *
         */
        SELECT_ACCESS_TOKEN_USERID => 'select id, user_id, access_token, expired from access_token where (id = ?)',

        /**
         *
         */
        GET_ACCOUNT_INFO => 'select id, username, password from user where (username = ?)',

    ];

/**
 * List queries has 2 parameters.
 */
const mysql_queries_2 =
    [
        /*
         *
         */
        VERIFY_ACCOUNT => 'call foodee.verify_account(?, ?)',

        /*
         *
         */
        LOGIN_ACCOUNT => 'call foodee.login(?, ?)'

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
    CREATE_VERIFY_CODE => 'insert into verify_status(user_id, code, expired) values(?, ?, ?)',

    /*
     *
     */
    CREATE_ACCESS_TOKEN => 'call foodee.create_token(?, ?, ?)',

    /**
     *
     */
    UPDATE_USER_USERNAME_PASSWORD => 'update user set password = ? where (username = ? and email = ?)'

];