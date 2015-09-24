<?php

/**
* 
*/
class LoginController extends BaseController
{
	
	public function postIndex()
	{

		if( Input::get('username') == '' && Input::get('password') == '' )
		{
			return Redirect::to('home')
	        		->with('login_error', '<div class="text-danger" style="margin: 0 0 10px 0;"><b>ERROR:</b> Username and Password is required.</strong> combination is incorrect.</div>')
	        		->withInput();
		}


		if(Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {	

			if( Auth::user()->activated == 0 )
			{
				Auth::logout();
				return Redirect::to('home')
	        		->with('login_error', '<div class="text-danger" style="margin: 0 0 10px 0;">It seems that your account is not yet activated. Please activate your account immediately. Activation link has been sent to your email.</div>');
			}
			else
			{
				return Redirect::to('home');	
			}

		} else {

		    return Redirect::to('home')
	        		->with('login_error', '<div class="text-danger" style="margin: 0 0 10px 0;"><b>ERROR:</b> Your <strong>username/password</strong> combination is incorrect.</div>')
	        		->withInput();
			
		}

	}

}