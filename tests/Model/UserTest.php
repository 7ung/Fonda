<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:42 AM
 */

namespace App\Model;


use Tests\TestCase;

require_once __DIR__.'/../../app/Model/_loader.php';

class UserTest extends TestCase
{
    public function test_isExistsUsername()
    {
        $existsUsername = 'tunghh';
        $notExistsUsername = 'dummdumm';

        $this->assertEquals(true, User::isExistsUsername($existsUsername));
        $this->assertEquals(false, User::isExistsUsername($notExistsUsername));
    }

    public function test_isExistsEmail()
    {
        $existsEmail = 'hohoangtung12a3@gmail.com';
        $notExistsEmail = 'dumm@dumm.dumm';
        $this->assertEquals(true, User::isExistsEmail($existsEmail));
        $this->assertEquals(false, User::isExistsEmail($notExistsEmail));

    }

    public function test_createUser()
    {
        $username = 'dumm';
        $password = 'dumm';
        $email = 'dumm@dumm';
        $this->assertTrue( User::createUser($username, $password, $email));
    }

    public function test_findByUsername()
    {
        $this->assertNotNull(User::findByUsername('tunghh'));
    }
}
