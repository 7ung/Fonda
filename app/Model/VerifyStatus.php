<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 12:16 PM
 */

namespace App\Model;


use Common\SimpleMailSender;
use Exceptions\MailSenderException;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

require_once __DIR__.'/../Exceptions/_loader.php';

/**
 * @property string code
 * @property false|int expired
 * @property  int user_id
 * @property int status
 * @property int tried_time
 */
class VerifyStatus extends Model
{
    protected $table = 'verify_status';

    public $timestamps = false;

    public $jsonName = 'verify_status';

    protected $hidden = [
        'code'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    /**
     * @param int $userId
     * @return bool
     */
    public static function createByUserId($userId)
    {
        $verifyStatus = new VerifyStatus();
        $verifyStatus->code = (string)random_int(111111, 999999);
        $date = strtotime('+3 days', (new \DateTime())->getTimestamp());
        $verifyStatus->expired = $date;
        $verifyStatus->user_id = $userId;

        return $verifyStatus->save();
    }

    public function isValidUser()
    {
        if ( $this->status != 3)
            return false;
        return true;
    }

    public function generateCode()
    {
        $this->code = (string)random_int(111111, 999999);
        $date = strtotime('+3 days', (new \DateTime())->getTimestamp());
        $this->expired = $date;
        $this->tried_time = 0;
        $this->status = 1;

        return $this->save();
    }

    public function hidden(){
        $this->makeHidden($this->hidden);
    }

    public static function sendMail($receiver, $code)
    {
        $mailSender = new SimpleMailSender();
        $body = mail_template['verify_code_required'][MAIL_BODY];
        $body = str_replace('{?}', $code, $body);

        try {
            $mailSender->sendEmail($receiver,
                mail_template['verify_code_required'][MAIL_SUBJECT],
                $body);
        }
        catch (\Exception $e){
            throw new MailSenderException($e->getMessage(), 500);
        }
    }

    public static function dumm()
    {
        $verifyStatus = new VerifyStatus();
        $verifyStatus->id = 0;
        $verifyStatus->code = '???';
        $verifyStatus->expired = time() + 2 * 24 * 60 * 60;
        $verifyStatus->tried_time = 0;
        $verifyStatus->status = 1;
        $verifyStatus->user_id = 0;
        return $verifyStatus;

    }
}