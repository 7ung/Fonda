<?php
/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/15/2017
 * Time: 3:53 PM
 */

namespace fonda;

$ini = parse_ini_file('app.ini');

/**
 * Common
 */
define('APP_NAME', $ini['app_name']);
define('APP_VERSION', $ini['app_version']);

/**
 * Database connection
 */
define('DB_HOST', $ini['db_host']);
define('DB_USER', $ini['db_username']);
define('DB_PASS',  $ini['db_password']);
define('DB_DBNAME', $ini['db_schema_name']);

/**
 * Quick hash salt use for hash username
 * because username don't need to hash strongly, it need to quick verify instead.
 */
define('QUICK_HASH_SALT', $ini['quick_hash_salt']);
define('STRONG_HASH_ARGTH', $ini['strong_hash_argth']);
define('STRONG_HASH_COST', $ini['strong_hash_cost']);

/**
 * Google mail authorization config
 */
define('OAUTH_USER_EMAIL', $ini['oauth_user_email']);
define('OAUTH_CLIENT_ID', $ini['oauth_client_id']);
define('OAUTH_CLIENT_SECRET', $ini['oauth_client_secret']);
define('OAUTH_REFRESH_TOKEN', $ini['oauth_refresh_token']);

/**
 * Mail config
 */
define('MAIL_AUTH_TYPE', $ini['auth_type']);
define('MAIL_HOST', $ini['host']);
define('MAIL_PORT', $ini['port']);
define('MAIL_SMTP_SUCURE', $ini['smtp_sucure']);

/**
 * Mail sender
 */
define('MAIL_SEND_FROM', $ini['sender_email']);
define('MAIL_SENDER_PASSWORD', $ini['password']);
define('MAIL_SENDER_NAME', $ini['sender_name']);
