<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Http\Response;
use Pnlinh\InfobipSms\InfobipSmsService;
use Pnlinh\InfobipSms\Providers\InfobipSmsServiceProvider;

class SendCode // extends Model
{
    
    /*public function setUp(): void
    {
        parent::setUp();
    }
    public function getPackageProviders($app)
    {
        return [
            InfobipSmsServiceProvider::class,
        ];
    }
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('infobip-sms.from', 'foo');
        $app['config']->set('infobip-sms.username', 'bar');
        $app['config']->set('infobip-sms.password', '123');
    }*/
    public static function sendcode($phone,$phonecode){
        
        $code = rand(1111,9999);
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '+'.$phonecode.$phone ,
            'from' => '+201227759022' ,
            'text' => 'Verify Code  : '. $code .' For B4moda' ,
            ]);
        
        return $code ;
        
        
       /* $infobipSmsService = new InfobipSmsService('foo', 'bar', '123');
        $response = $infobipSmsService->send('+'.$phonecode.$phone , 'la la la');
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response[0]);*/
    } 
    
    
}
