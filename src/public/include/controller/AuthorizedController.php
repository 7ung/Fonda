<?php
use model\AccessToken;
use model\Member;
use model\UserRoleModel;
use responses\ResponseBuilder;

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/07/2017
 * Time: 11:17 AM
 */
abstract class AuthorizedController extends \fonda\controller\Controller
{
    protected $accessToken;

    protected $user;

    abstract function getRoleName();

    /**
     * @param \Slim\Http\Request $request
     * @return int Trả về mã lỗi. Trả về 0 nếu success
     * @throws Exception
     */
    protected function preExecute(\Slim\Http\Request $request){

        $tokenString = $request->getParam('token', null);
        if ($tokenString == null)
            return 40001;

        $tokenString = \common\putHashPrefix($tokenString);         // thêm chuỗi '$2y$10$'
        $this->accessToken = $this->findAccessToken($tokenString);
        if ($this->accessToken == null)
            return 40001;

        $this->user = $this->findUser($this->accessToken->userId);
        $this->accessToken->user = $this->user;

        $userRole = $this->findUserRole($this->getRoleName());
        $this->user->userRole = $userRole;

        if ($userRole == null)
            throw new Exception('Lỗi db. Phải có '.$this->getRoleName().' trong bảng user_role');

        if ($this->user->userRoleId != $userRole->id)
            return 40001;
        return 0;
    }


    /**
     * @param $tokenString
     * @return \entities\Token
     */
    private function findAccessToken($tokenString) {
        $token = new AccessToken();
        return $token->findTokenByTokenString($tokenString);
    }


    /**
     * @param $userId
     * @return \entities\User
     */
    private function findUser($userId) {
        $member = new Member();
        return $member->findUserById($userId);
    }

    /**
     * @param $roleName
     * @return \entities\UserRole
     */
    private function findUserRole($roleName)
    {
        $userRole = new UserRoleModel();
        return $userRole->findByCode($roleName);
    }
}