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

    public function test_getInfo()
    {
        $username = '121212';
        $password = '121212';

        try {
            $accessToken = new AccessToken($username, $password);
            $refection = new ReflectionClass($accessToken);

            $method = $refection->getMethod('getInfo');
            $method->setAccessible(true);
            $this->assertNotNull($method->invoke($accessToken));

        }
        catch (ResponseJsonError $error)
        {
            $this->fail($error->getMessage());
        }
    }

    public function test_getAccessToken()
    {
        $username = '121212';
        $password = '121212';

        try {
            $accessToken = new AccessToken($username, $password);
            $this->assertNotNull($accessToken->getAccessToken());
        }
        catch (ResponseJsonError $error)
        {
            $this->fail($error->getMessage());
        }
    }
}
