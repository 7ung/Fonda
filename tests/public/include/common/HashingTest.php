<?php

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 10:03 AM
 */

require_once __DIR__.'/../../../../src/public/include/_loader.php';

class HashingTest extends PHPUnit_Framework_TestCase
{
    function test_strong_hashing()
    {
        echo \common\strong_hashing('121212');
    }

    function test_randString()
    {
        echo \common\randString(12);
    }

    function test_removeHashPrefix(){
        $this->assertEquals('7139',\common\removeHashPrefix('$2y$10$7139'));
        $this->assertEquals('98765',\common\removeHashPrefix('98765'));
        $this->assertNotEquals('1234',\common\removeHashPrefix('$2y$101234'));
    }
}
