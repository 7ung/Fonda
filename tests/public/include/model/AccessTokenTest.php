<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/26/2017
 * Time: 1:44 PM
 */

namespace model;


use PHPUnit\Framework\TestCase;
use ReflectionClass;
use responses\ResponseJsonError;

require_once __DIR__.'/../../../../src/public/include/_loader.php';

class AccessTokenTest extends TestCase
{
    private $model;

    public function setUp(){
        $this->model = new AccessToken();
    }

    public function test_findTokenByTokenString(){
        $this->assertNotNull($this->model->findTokenByTokenString('$2y$10$vaMvPNeBzyQbWUkrUwZ7NuHS3I9ob89I3BKnmI4vYJGpH4w678Bgi'));
        $this->assertNull($this->model->findTokenByTokenString('$2y$10$vaMvPNeBzyQbWUkrUwZ7NuHS3'));
        $this->assertNull($this->model->findTokenByTokenString('hghgh'));

    }
}
