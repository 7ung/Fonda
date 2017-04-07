<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 8:30 PM
 */

namespace model;

use entities\Fonda;
use responses\ResponseJsonError;

require_once __DIR__.'/../../../../src/public/include/_loader.php';

class FondaModelTest extends \PHPUnit_Framework_TestCase
{
    private $model;

    public function setUp(){
        $this->model = new FondaModel();
    }

    public function test_save(){
        $fonda1 = new Fonda();
        $fonda1->name = 'Mộc';
        $fonda1->locationId = 1;
        $fonda1->groupId = 1;
        $fonda1->scale = 2;

        $fonda2 = new Fonda();
        $fonda2->name = 'Dummy';
        $fonda2->locationId = 1;
        $fonda2->groupId = 1;
        $fonda2->scale = 1;
        $fonda2->openTime = '08:30:00';
        $fonda2->closeTime = '20:30:00';
        $fonda2->openDay = \common\__dayOfWeek['AllExceptSun'];
        $fonda2->phone1 = '0010203103';
        $fonda2->phone2 = '8573647235';

        try {
            $this->model->save($fonda1);
            $this->model->save($fonda2);
        }
        catch (\Exception $e){
            self::fail($e->getMessage());
        }
    }
}
