<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 8:55 PM
 */

namespace model;

require_once __DIR__.'/../../../../src/public/include/_loader.php';

class LocationModelTest extends \PHPUnit_Framework_TestCase
{
    private $model;

    public function setUp(){
        $this->model = new LocationModel();
    }

    public function test_findLocationById(){
        $this->assertNotNull($this->model->findLocationById(1));
        $this->assertNull($this->model->findLocationById(0));

    }
}
