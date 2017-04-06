<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 9:09 AM
 */

namespace model;


use PHPUnit\Framework\TestCase;
use Reflection;

require_once __DIR__.'/../../../../src/public/include/_loader.php';

/*
 * @covers Member
 */
class MemberTest extends TestCase
{

    private $member;
    public function setUp(){
        $this->member = new Member();
    }
    function test_findUserByUsername(){
        $username = 'tunghh';

        $this->assertNotNull($this->member->findUserByUsername($username));
    }

    function test_isExistsByUsername(){
        $this->assertEquals(true, $this->member->isExistsByUsername('tunghh'));
        $this->assertEquals(false, $this->member->isExistsByUsername('dumm'));
    }

    function test_findUserByEmail(){
        $this->assertNotNull($this->member->findUserByEmail('hohoangtung12a3@gmail.com'));
    }


    function test_isExistsByEmail(){

        $this->assertEquals(true, $this->member->isExistsByEmail('hohoangtung12a3@gmail.com'));
        $this->assertEquals(false, $this->member->isExistsByEmail('dumm@dumm.dumm'));
    }

    function test_findUserById(){
        $this->assertNotNull($this->member->findUserById(74)); // 74 is tunghh
        $this->assertNull($this->member->findUserById(1));
    }
}
