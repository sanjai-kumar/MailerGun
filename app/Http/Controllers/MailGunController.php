<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function get_template() {


        $service_url = 'https://api.mailgun.net/v3/sandboxcec62448d7c84db0833ee6370077c724.mailgun.org/templates';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "api:b355dbbb212ccaa7882f09b00756f084-8845d1b1-463901f2"); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_GET, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);

        var_dump($response);

        // $ch = curl_init();
      
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($ch, CURLOPT_USERPWD, 'b355dbbb212ccaa7882f09b00756f084-8845d1b1-463901f2');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/YOUR_DOMAIN_NAME/templates/');
      
        // $result = curl_exec($ch);
        // curl_close($ch);
    //   dd($result);
    //     return $result;
      }
      
      public function User() {


        $service_url = 'https://api.mailgun.net/v3/sandboxcec62448d7c84db0833ee6370077c724.mailgun.org/templates';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "api:b355dbbb212ccaa7882f09b00756f084-8845d1b1-463901f2"); //Your credentials goes here
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

        //     return $result;
      }

      public function Store(Request $request){
        
        $validated = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "template" => "required",
        ]);
        $data = $request->all(); 
        $service_url = 'https://api.mailgun.net/v3/sandboxcec62448d7c84db0833ee6370077c724.mailgun.org/templates'.'/'.$data['template'];
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "api:b355dbbb212ccaa7882f09b00756f084-8845d1b1-463901f2"); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_GET, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);


        $data = $request->all();
        $user = new User();
        $user->first_name  = $data['first_name']  ;
        $user->last_name  =   $data['last_name'];
        $user->template  =   $data['template'];
        $user->status  =   1;
        $user->save();


        $user['email'] = 'msanjai3107@gmail.com';
        


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
      }
      
}
