<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:58 AM
 */

namespace Common;


require_once __DIR__.'/../../app/Common/_loader.php';

class HashingTest extends \PHPUnit_Framework_TestCase
{
    public function test_quickHashing(){
        echo quick_hashing('tunghh');
    }
}
