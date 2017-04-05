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


    function testCreateUser(){
        $username = '12112';
        $password = '121';
        $email = 'hghghgh@hh';
        $member = new Member($username, $password, $email);
        $this->assertNotNull($member->createUser());

    }

    function test_findUserByUsername(){
        $username = 'tunghh';
        $password = '';// don't care
        $member = new Member($username, $password);
        $this->assertNotNull($member->findUserByUsername());
    }

    function test__(){
        $username = 'tunghh';
        $password = '';// don't care
        $member = new Member($username, $password);
        $user = $member->findUserByUsername();
        $this->assertEquals(true, \common\verify_string('123456', $user->temporaryPassword));

    }


}
