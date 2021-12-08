<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Emailsettings; 
use Validator;
use Redirect;
use DB;

class EmailsettingsController extends Controller
{
    public function Emailsettings(){
        $esettings = Emailsettings::first();
        return view('email-settings',compact('esettings'));
    }

	public function Emailsetting_update(Request $request){
        $validator = Validator::make($request->all(), [
            'email_from_address' => 'required',
			'email_from_name' => 'required', 
        ]);
        if($validator->fails()){
            return back()->with('error', 'Error in updating settings');
        }
        $esetting=Emailsettings::first();
        if(!empty($esetting)){
            $esetting->mailoption=$request->mailoption;
            $esetting->email_from_address=$request->email_from_address;
            $esetting->email_from_name=$request->email_from_name;
            $esetting->smtp_host=$request->smtp_host;
            $esetting->smtp_user=$request->smtp_user;
            $esetting->smtp_password=$request->smtp_password;
            $esetting->smtp_port=$request->smtp_port;
            $esetting->smtp_security=$request->smtp_security;
            $esetting->smtp_domain=$request->smtp_domain;             
            $esetting->save();
        }else{
            $esetting = new Emailsettings();
			$esetting->mailoption=$request->mailoption;
            $esetting->email_from_address=$request->email_from_address;
            $esetting->email_from_name=$request->email_from_name;
            $esetting->smtp_host=$request->smtp_host;
            $esetting->smtp_user=$request->smtp_user;
            $esetting->smtp_password=$request->smtp_password;
            $esetting->smtp_port=$request->smtp_port;
            $esetting->smtp_security=$request->smtp_security;
            $esetting->smtp_domain=$request->smtp_domain; 
            $esetting->save();
        }
        return back();
    }



	/*public function saveEmailsettings(Request $request){
	$saveemail = DB::table('emailsettings')->insert([
			'mailoption' => $request -> mailoption,
			'email_from_address' => $request -> email_from_address,
			'email_from_name' => $request -> email_from_name,
			'smtp_host' => $request -> smtp_host,
			'smtp_user' => $request -> smtp_user,
			'smtp_password' => $request -> smtp_password,
			'smtp_port' => $request -> smtp_port,
			'smtp_security' => $request -> smtp_security,
			'smtp_domain' => $request -> smtp_domain,
		]);
		//return back()->with('emailsettings_add','Email added Successfully');

		$updateemail = DB::table('emailsettings')->update([
			'mailoption' => $request -> mailoption,
			'email_from_address' => $request -> email_from_address,
			'email_from_name' => $request -> email_from_name,
			'smtp_host' => $request -> smtp_host,
			'smtp_user' => $request -> smtp_user,
			'smtp_password' => $request -> smtp_password,
			'smtp_port' => $request -> smtp_port,
			'smtp_security' => $request -> smtp_security,
			'smtp_domain' => $request -> smtp_domain,
		]);
	}*/

	/*public function EmailsettingsList(){
		$email = DB::table('emailsettings')->get();
		return view('email-settings', compact('email'));		 
	}
	public function editEmailsettings(){
		$editemail = DB::table('emailsettings')->first();
		//dd($editemail);
		return view('email-settings', compact('editemail'));		
	}
	public function updateEmailsettings(Request $request){
		$updateemail = DB::table('emailsettings')->update([
			'mailoption' => $request -> mailoption,
			'email_from_address' => $request -> email_from_address,
			'email_from_name' => $request -> email_from_name,
			'smtp_host' => $request -> smtp_host,
			'smtp_user' => $request -> smtp_user,
			'smtp_password' => $request -> smtp_password,
			'smtp_port' => $request -> smtp_port,
			'smtp_security' => $request -> smtp_security,
			'smtp_domain' => $request -> smtp_domain,
		]);
		 
		return back()->with('email_update', 'Email Updated Successfully');		
	}*/
}
