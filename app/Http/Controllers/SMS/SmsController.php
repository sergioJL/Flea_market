<?php

namespace App\Http\Controllers\SMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    //
    public function __construct()
    {
    }

    /**
     * @var string
     */
    protected $template;

    /**
     * @param Request $request
     * @return int
     */
    public function sendSms(Request $request)
    {
        $phone = $request->get('phone');
        $type = $request->get('type');

        $template = 'SMS_188565401';

        /*if(strcmp('register',$type))
        {
            $template = 'SMS_188565401';
        }
        else
        {
            $template = '';
        }*/
        $sms = app('easysms');
        $code = rand(1000,9999);
        try {
            $sms->send($phone, [
                'template' => $template,
                'data' => [
                    'code' => $code
                ],
            ]);
            session_start();
            session()->put('phone',$code);
            return 0;
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('aliyun')->getMessage();
            var_dump($message);
        }
    }
}
