<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 9:04 PM
 */

namespace model;

require_once __DIR__.'/../../../../src/public/include/_loader.php';

class FondaGroupModelTest extends \PHPUnit_Framework_TestCase
{
    private $model;

    public function setUp(){
        $this->model = new FondaGroupModel();
    }

    public function test_findFondaGroupById(){
        $this->assertNotNull($this->model->findFondaGroupById(1));
        $this->assertNull($this->model->findFondaGroupById(0));

    }
}
