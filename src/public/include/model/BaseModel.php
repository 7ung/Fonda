<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/20/2017
 * Time: 8:35 AM
 */

namespace model;

use exception\MySqlExecuteFailException;
use fonda\db\Connection;
use mysqli_stmt;

require_once __DIR__.'/../db/Connection.php';


abstract class BaseModel
{

    private $connection;

    function __construct()
    {
        $this->connection = (new Connection())->connect();
    }

    function __destruct()
    {
        $this->connection->close();
    }

    protected function getConnection()
    {
        return $this->connection;
    }

    protected function prepare()
    {
        $arg_count = func_num_args();
        $stmt = $this->connection->prepare(func_get_arg(0));

        switch ($arg_count)
        {
            case 0:
            case 2:
                throw new \InvalidArgumentException('must not have 2 arguments');
            case 3:
                $args = func_get_args();
                $stmt->bind_param($args[1], $args[2]);
                break;
            case 4:
                $args = func_get_args();
                $stmt->bind_param($args[1], $args[2], $args[3]);
                break;
            case 5:
                $args = func_get_args();
                $stmt->bind_param($args[1], $args[2], $args[3], $args[4]);
                break;
            /**
             * If bind 4 or more params, you should get stmt and manual bind_param
             */
        }
        return $stmt;
    }

    /**
     * @param mysqli_stmt $stmt
     * @param $callback: called if execute successfully
     * @return mixed
     * @throws MySqlExecuteFailException
     */
    protected function execute(mysqli_stmt &$stmt, $callback)
    {
        if ($stmt->execute() == 0)
        {
            // execute fail
            $error_msg = $stmt->error;
            $stmt->close();
            throw new MySqlExecuteFailException($error_msg);
        }
        else
        {
            /**
             * todo: ai đó nói rằng.
             * method 'store_result()' must be called and be called in correct order.
             * Failure to observe this causes PHP/MySQLi to crash or return an erroneous value.
             * nên nếu fail thì check lại hàm này.
             */
            $stmt->store_result();

            $rs = call_user_func($callback);
            $stmt->close();
            return $rs;
        }
    }

    function refresh()
    {
        $this->connection->close();
        $this->connection = (new Connection())->connect();
    }

    protected function lastInsertId()
    {
        $stmt = $this->prepare(mysql_queries[LAST_INSERT_ID]);
        return $this->execute($stmt, function () use ($stmt)
        {
            $rs = 0;
            $stmt->bind_result($rs);
            $stmt->fetch();
            return $rs;
        });
    }
}