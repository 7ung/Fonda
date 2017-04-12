<?php

namespace App\Model\Observers;
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 9:02 PM
 */
use App\Model\Profile;
use App\Model\User;
use App\Model\VerifyStatus;
use Exceptions\MySqlExecuteFailException;

require_once __DIR__.'/../../Exceptions/_loader.php';
//require_once __DIR__.'/../_loader.php';

class UserObserver
{
    public function created(User $user)
    {
//        $rs = VerifyStatus::createByUserId($user->id);
//
//        if ($rs == false) {
//            $user->delete();
//            throw new MySqlExecuteFailException('Can not create verify status - User has been discarded');
//        }
//
//        $user->verify_status();
//
//        $rs = Profile::createByUser($user);
//        if ($rs == false)
//        {
//            $user->delete();
//            throw new MySqlExecuteFailException('Can not create verify status - User has been discarded');
//        }
    }

    /**
     * Chỉ delete trong trường hợp create không thành công.
     * @param User $user
     */
    public function deleting(User $user)
    {
//        if ($user->verify_status != null)
//            $user->verify_status->delete();
//        if ($user->profile != null)
//            $user->profile->delete();
    }
}