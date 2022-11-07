<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailSent;
use Mail;
use Validator;
use Mailgun\Mailgun;

class MailGunController extends Controller
{
    public function index()
    {
    	$user['email'] = 'msanjai3107@gmail.com';
        
	    Mail::send('email.email-template', $user, function($message) use ($user) {
	        $message->to($user['email']);
	        $message->subject('Testing Mailgun');
	    });

	    // dd('Mail Send Successfully');
    }

// testing 
// http://127.0.0.1:8000/get_template  use to check this testing route

    public function get_template() {

        try{                                                        

        $hostname = env("MAIL_HOSTURL"); 
        $CURLOPT_USERPWD = env("MAILGUN_SECRET"); 
        // echo "<pre>";
        $Sercet_key = 'api:'.$CURLOPT_USERPWD;
        // var_dump($Sercet_key);

        $service_url = $hostname;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Sercet_key); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_GET, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);
        echo "<pre>";
        var_dump($response);

    }catch (\Exception $e){
        return response()->json([
        'status'  => 'false',
        'Message' => 'API MAILGUN Credentials ISSUE'], 200);
    }

      }
      
      public function User() {

        try{                                                        

        // host url
        $hostname = env("MAIL_HOSTURL"); 
        // credentials
        $CURLOPT_USERPWD = env("MAILGUN_SECRET"); 
        $Sercet_key = 'api:'.$CURLOPT_USERPWD;
        // echo "<pre>";
        // var_dump($mgClient);exit;
        $service_url = $hostname;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Sercet_key); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_GET, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);


            $data = [
                "email_template" => $response,
            ];
        //   dd($response);

        return view('admin.user', $data);

        }catch (\Exception $e){
            return response()->json([
              'status'  => 'false',
              'Message' => 'API MAILGUN Credentials ISSUE'], 200);
        }

        //     return $result;
      }

      public function Store(Request $request){

        // try{                                                        
        
        $validated = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "template" => "required",
        ]);
        $data = $request->all(); 

        $data = $request->all();
        $user = new User();
        $user->first_name  = $data['first_name']  ;
        $user->last_name  =   $data['last_name'];
        $user->template  =   $data['template'];
        $user->status  =   1;
        $user->save();

        if(!empty(env("USER_EMAIL"))){
            $USER_EMAIL = env("USER_EMAIL"); 
        }else{
            $USER_EMAIL = 'msanjai3107@gmail.com'; 
        }

        $email = new EmailSent();
        $email->first_name  = $data['first_name']  ;
        $email->last_name  =   $data['last_name'];
        $email->template  =   $data['template'];
        $email->receiver_email  =  $USER_EMAIL;
        $email->save();

        // $USER_EMAIL = env("USER_EMAIL"); 
        $user['email'] = $USER_EMAIL;
        

    //     $mgClient = Mailgun::create(
    //         env('MAILGUN_SECRET'), // Mailgun API Key
    //         env('Mail_Client'), 
    //    );

    //    $params = array(
    //     'from' => env('MAIL_USERNAME'),
    //     'to' => $user['email'],
    //     'subject' => 'Test Task',
    //     'template' => $request->template,
    //     'v:first_name' => $request->first_name,
    //     'v:last_name' => $request->last_name,
    // );
    //    $domain = env('MAILGUN_DOMAIN');

    // $mgClient->messages()->send($domain, $params);

    $mgClient = Mailgun::create(
        env('MAILGUN_SECRET'), // Mailgun API Key
        env('Mail_Client'), 
   );

        //    echo "<pre>";
        // var_dump($mgClient);exit;
$domain =  env('MAILGUN_DOMAIN');

# Make the call to the client.
$result = $mgClient->messages()->send("$domain",
	array('from'    =>  env('MAIL_USERNAME'),
		  'to'      => $USER_EMAIL,
		  'subject' => 'Hello M Sanjai Kumar',
		  'template'    => $request->template,
		  'h:X-Mailgun-Variables'    => '{"test": "Hello '.$request->first_name.' '.$request->last_name.'"}'));

// blade email 

       $domain = env('MAILGUN_DOMAIN');
        Mail::send('email.email-template', array(
            /* 'activation_code', $user->activation_code,*/
            'first_name'=>$request->first_name, 
            'last_name' => $request->last_name, 
            'template' => $request->template,
            ), function($message) use ($data,$user) {
                    $message->to($user['email']);
                    $message->subject('Testing Mailgun');
                });

    return \Redirect::back()->with(
        "message",
        "Mail Send Successfully"
    );
    
        // }catch (\Exception $e){
        //     return response()->json([
        //     'status'  => 'false',
        //     'Message' => 'Mail Not Sent..!'], 200);
        // }
      }
      
}
