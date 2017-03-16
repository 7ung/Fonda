<?php
/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/15/2017
 * Time: 4:17 PM
 */

namespace fonda\db;

class Connection{
    private $conn;

    function __construct() {
    }

    function connect(){
        require_once __DIR__.'/../config.php';
        $this->conn = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            // todo: ....
        }
        return $this->conn;
    }
}