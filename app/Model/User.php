<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/10/2017
 * Time: 6:56 PM
 */

namespace App\Model;


use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

require_once __DIR__.'/../Common/_loader.php';

/**
 * @property string username
 * @property string password
 * @property  int created_date
 * @property  string email
 * @property mixed id
 */
class User extends Model
{
    use Notifiable;
    //
    protected $table = 'user';

    public $timestamps = false;

    public $jsonName = 'user';

    protected $hidden = [
        'username', 'password'
    ];

    public function verify_status()
    {
        return $this->hasOne('App\Model\VerifyStatus');
    }

    public function access_token()
    {
        return $this->hasOne('App\Model\AccessToken');
    }

    public function profile()
    {
        return $this->hasOne('App\Model\Profile');
    }

    /**
     * @param $newPassword
     * @return bool
     */
    public function changePassword($newPassword)
    {
        $password = \Common\strong_hashing($newPassword);
        $this->password = $password;

        try{
            DB::beginTransaction();
            $this->save();              // update password
            $this->access_token->delete();     // delete token.
            DB::commit();

            return true;
        }
        catch(QueryException $exception){
            DB::rollBack();
            return false;
        }
    }
    /**
     * @param $username
     * @return bool
     */
    public static function isExistsUsername($username)
    {
        $username = \Common\quick_hashing($username);
        return User::where('username', '=', $username)->first() != null;
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function isExistsEmail($email)
    {
        return User::where('email', '=', $email)->first() != null;
    }

    public static function createUser($username, $password, $email)
    {
        $username = \Common\quick_hashing($username);
        $password = \Common\strong_hashing($password);

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->created_date = $_SERVER['REQUEST_TIME'];


        try {
            DB::beginTransaction();
            $user->save();
            VerifyStatus::createByUserId($user->id);
            Profile::createByUser($user);
            DB::commit();
            return true;
        }
        catch (QueryException $exception)
        {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $username
     * @return User
     */
    public static function findByUsername($username)
    {
        $username = \Common\quick_hashing($username);
        return User::where('username', '=', $username)->first();
    }

    public function hidden(){
        $this->makeHidden($this->hidden);
    }
}
