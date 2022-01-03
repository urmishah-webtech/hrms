<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
	 
  //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }
	private function validator(Request $request)
	{
		//validation rules.
		$rules = [
			'email'    => 'required|email|exists:employees|min:5|max:191',
			'password' => 'required|string|min:4|max:255',
		];

		//custom validation error messages.
		$messages = [
			'email.exists' => 'These credentials do not match our records.',
		];

		//validate the request.
		$request->validate($rules,$messages);
	}
	private function loginFailed()
	{
		return redirect()
			->back()
			->withInput()
			->with('error','Login failed, please try again!');
	}
	public function login(Request $request)
	{
		
		$this->validator($request);
		
		if(auth()->attempt($request->only('email','password'),$request->filled('remember'))){
			//Authentication passed...
			if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {  				
		 		return redirect()->route('index');
			}else{
                return redirect('/employee-dashboard'); 
            }
		}
		
		
		//Authentication failed...
		return $this->loginFailed();
	}
	public function logout()
	{
		Auth::logout();
		return redirect()
			->route('login')
			->with('status','Admin has been logged out!');
	}
}
