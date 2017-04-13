<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 3:27 PM
 */

namespace App\Model;


use Exceptions\MySqlExecuteFailException;
use Illuminate\Database\Eloquent\Model;

require_once __DIR__.'/../Common/_loader.php';

/**
 * @property string access_token
 * @property int expired
 * @property int user_id
 */
class AccessToken extends Model
{
    protected $table = 'access_token';

    public $timestamps = false;

    public $jsonName = 'access_token';

    protected $hidden = ['access_token'];

    protected $appends = ['token_string'];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    /**
     * @param int $userId
     * @return AccessToken|Model|null|static
     * @throws MySqlExecuteFailException
     */
    public static function getTokenByUserId($userId)
    {
        $accessToken = AccessToken::where('user_id', '=', $userId)->first();
        if ($accessToken == null){
            $accessToken = new AccessToken();
            $accessToken->access_token = \Common\generateToken($userId);
            $accessToken->expired = 0;
            $accessToken->user_id = $userId;

            $rs = $accessToken->save();
            if ($rs == false)
                throw new MySqlExecuteFailException('Can not create access token');
        }
        return $accessToken;
    }

    public function getTokenStringAttribute()
    {
        return \Common\removeHashPrefix($this->access_token);
    }

    public static function dumm()
    {
        $token = new AccessToken();
        $token->access_token = '???';
        $token->user_id = 0;
        $token->id = 0;
        $token->expired = 0;
        return $token;
    }
}