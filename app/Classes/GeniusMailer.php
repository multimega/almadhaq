<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\Models\EmailTemplate;
use App\Models\Generalsetting;
use App\Models\Order;
use PDF;
use Illuminate\Support\Facades\Mail;
use Config;

class GeniusMailer
{

    public function __construct()
    {
        $gs = Generalsetting::findOrFail(1);
        Config::set('mail.host', $gs->smtp_host);
        Config::set('mail.port', $gs->smtp_port);
        Config::set('mail.encryption', $gs->email_encryption);
        Config::set('mail.username', $gs->smtp_user);
        Config::set('mail.password', $gs->smtp_pass);
    }


    public function sendAutoOrderMail(array $mailData,$id)
    {
        $setup = Generalsetting::find(1);




        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
        $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
        $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
        $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
        $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
        $body = preg_replace("/{website_title}/", $setup->title ,$body);

        $data = [
            'email_body' => $body
        ];


        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $temp->email_subject;

        try{/*
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo,$id) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $fileName = public_path('assets/prints/').str_random(4).time().'.pdf';
        $pdf = PDF::loadView('print.order', compact('order', 'cart'))->save($fileName);
                $message->attach($fileName);


            });

        */
            
        
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
            
            
            
        }
        catch (\Exception $e){
            //die("Not Sent!");
              die($e->getMessage());
        }
/*
        $files = glob('assets/prints/*'); //get all file names
        foreach($files as $file){
            if(is_file($file))
            unlink($file); //delete file
        }*/
        
        return true;

    }

    public function sendAutoMail(array $mailData)
    {
        $setup = Generalsetting::find(1);

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
        $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
        $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
        $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
        $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
        $body = preg_replace("/{website_title}/", $setup->title ,$body);

        $data = [
            'email_body' => $body
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $temp->email_subject;

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            //die("Not Sent!");
        }
    }

    public function sendCustomMail(array $mailData)
    {
        $setup = Generalsetting::find(1);

        $data = [
            'email_body' => $mailData['body']
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];

        try{
            Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            die($e->getMessage());
            // return $e->getMessage();
        }
        return true;
    }

    public function sendCustomMailToUser(array $mailData, $orderId)
    {
        $order = Order::find($orderId);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        
        $products = [];
        foreach ($cart->items as $prod) {
            $products[] = $prod;
        }
        $images = [];
        foreach ($cart->items as $prod) {
            $images[] = asset('assets/images/products/' . $prod['item']['photo']);
        }

        $setup = Generalsetting::find(1);

        $data = [
            'email_body' => $mailData['body'],
            'order' => $order,
            'images' => $images,
            'products' => $products,
        ];
        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];

        try {
            Mail::send('admin.email.user-mail-body', $data, function ($message) use ($objDemo) {
                $message->from($objDemo->from, $objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return true;
    }

    public function sendCustomMailToAdmin(array $mailData)
    {
        $setup = Generalsetting::find(1);
        $data = [
            'email_body' => $mailData['body'],
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->from = $setup->from_email;
        $objDemo->title = $setup->from_name;
        $objDemo->subject = $mailData['subject'];

        try {
            Mail::send('admin.email.admin-mail-body', $data, function ($message) use ($objDemo) {
                $message->from($objDemo->from, $objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return true;
    }
}