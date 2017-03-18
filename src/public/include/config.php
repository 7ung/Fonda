<?php
/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/15/2017
 * Time: 3:53 PM
 */

namespace fonda;

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '0918280427');
define('DB_DBNAME', 'foodee');

/**
 * Quick hash salt use for hash username
 * because username don't need to hash strongly, it need to quick verify instead.
 */
define('QUICK_HASH_SALT', '$1$Olt2e0$');
define('STRONG_HASH_ARGTH', PASSWORD_BCRYPT);
define('STRONG_HASH_COST', 10);