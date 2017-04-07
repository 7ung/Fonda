<?php
use fonda\controller\Controller;
use model\AccessToken;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonError;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 10:07 AM
 */

require_once 'AuthorizedController.php';

class UpgradeUserController extends AuthorizedController
{

    function getMethod()
    {
        return [GET];
    }

    function getUrl()
    {
        return '/upgrade_user';
    }

    function getRoleName()
    {
        return 'Guess';
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
        $_code = $this->preExecute($request);
        if ($_code != 0)
            return ResponseJsonBadRequest::responseBadRequest($request, $response, $_code);

        $userId = $request->getParam('id');

        try{
            $this->assertNotNullParams($userId, 'User id must not empty');

            $userRoleModel = new \model\UserRoleModel();
            $userRole = $userRoleModel->findByCode('Vendor');

            if ($userRole == null){
                throw new Exception('Lỗi db. Phải có Vendor trong bảng user_role'); // khỏi catch. để nó quăng chơi
            }
            $member = new \model\Member();
            $user = $member->findUserById($userId);

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