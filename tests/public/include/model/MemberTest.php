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


    function testLoginSuccess()
    {
        $username = '121212';
        $password = '121212';
        $member = new Member($username, $password);
        $this->assertNotEquals(0, $member->login());
    }
}
