<?php
use fonda\controller\Controller;
use model\AccessToken;
use responses\ResponseBuilder;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 10:07 AM
 */

require_once 'Controller.php';

class UpgradeUserController extends Controller
{

    function getMethod()
    {
        return [GET];
    }

    function getUrl()
    {
        return '/upgrade_user';
    }


    /**
     * params: id, token
     * Step 1: find user by id => user. assert user not null
     * Step 2: find access_token by user.id and token => access_token. assert acess_token not null
     * Step 3: ind Role By Name = 'Vendor' => role. assert role not null
     * Step 4: set user.userRoleId = role.id
     * @param Request $request
     * @param Response $response
     */
    function exec(Request $request, Response $response)
    {
        $userId = $request->getParam('id');
        $token = $request->getParam('token');

        try{
            $this->assertNotNullParams($userId, 'User id must not empty');
            $this->assertNotNullParams($token, 'User token must not empty');

            $accessTokenModel = new AccessToken();

            $userToken = $accessTokenModel->findTokenByUserId($userId);
            if ($userToken == null || $userToken->token != $token){
                $response = ResponseBuilder::build(
                    new \responses\ResponseJsonBadRequest('Token is invalid', 40001),
                    $response, $request, 400
                );
                return $response;
            }

            $userRoleModel = new \model\UserRoleModel();
            $userRole = $userRoleModel->findByCode('Vendor');

            if ($userRole == null){
                throw new Exception('Lỗi db. Phải có Vendor trong bảng user_role'); // khỏi catch. để nó quăng chơi
            }
            $member = new \model\Member();
            $user = $member->findUserById($userId);

            if ($user->userRoleId == $userRole->id){
                return ResponseBuilder::build(
                    new \responses\ResponseJsonBadRequest('User has upgraded yet',40601),
                    $response,$request, 406
                );
            }

            $user->userRoleId = $userRole->id;
            $user->userRole = $userRole;

            $member->save($user);

            $response = ResponseBuilder::build($user, $response, $request, 200);
        }
        catch(ResponseJsonError $jsonError){
            $response = ResponseBuilder::build($jsonError, $response, $request, 500);
        }
        return $response;
    }
}