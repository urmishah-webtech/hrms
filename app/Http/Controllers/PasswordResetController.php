<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mail\ForgotPasswordMail;
use App\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function forgotpassword(){
        return view('forgot-password');
    }

    public function sendmail(Request $request){
        $checkemail = Employee::where('email', $request->email)->first();
        if ($checkemail) {
            $token = Str::random(40);
            $checktoken = PasswordReset::where('email', $request->email)->exists();
            if ($checktoken) {
                PasswordReset::where('email', $request->email)->update(['token' => $token]);
            } else {
                PasswordReset::create(['email' => $request->email, 'token' => $token]);
            }
            $email = [
                $checkemail->first_name => $request->email
            ];
            \Mail::to($email)->send(new ForgotPasswordMail($request->email, encrypt($checkemail->id), $checkemail->first_name, $token));
            if (\Mail::failures()) {
                $message = "Something went wrong";
                $status = 2;
            }
            else {
                $message = "Mail has been successfully sent to : ".$request->email;
                $status = 1;
            }
            return redirect()->back()->with('msg', $message)->with('status', $status);
        } else {
            return redirect()->back()->with('message', 'Email does not exist');
        }
    }

    public function resetpassword($id, $token){
        $id = decrypt($id);
        $getemail = Employee::find($id);
        $checktoken = PasswordReset::where('email', $getemail->email)->first();
        if($checktoken){
            if ($checktoken->token == $token) {
            return view('resetpassword')->with('id', $id)->with('token', $token);
            } else {
                return view('tokenexpired');
            } 
        } 
        else {
                return view('tokenexpired');
            } 
    }

    public function setnewpassword(Request $request){
        $password = Hash::make($request->confirmpass);
        $getemail = Employee::find($request->userid);
        Employee::where('id', $request->userid)->update(['password' => $password]);
        PasswordReset::where('email', $getemail->email)->delete();
        return redirect('/');
    }
}
