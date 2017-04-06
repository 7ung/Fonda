<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 12:06 PM
 */

namespace model;


use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../../../../src/public/include/_loader.php';

class UserRoleModelTest extends TestCase
{
    private $model;

    public function setUp(){
        $this->model = new UserRoleModel();
    }

    public function test_findByCode(){
        $this->assertNotNull($this->model->findByCode('Vendor'));
        $this->assertNull($this->model->findByCode('dumm'));

    }
}
