<?php

/**
* 
*/
class userController extends BaseController
{
	
	protected $layout = "layouts.master";

	public function getRegister()
	{
		$this->layout->content = View::make('userRegistration');
	}

	public function postNew()
	{

		$validator = Validator::make(
				Input::get(),
				array(
					'firstname'	=> 'required',
					'middlename'	=> 'required',
					'lastname'		=> 'required',
					'username'		=> 'required',
					'password'		=> 'required|confirmed',
					'email'			=> 'required|email'
				)
			);

		if ($validator->fails())
		{	
		   return Redirect::to('user/register')->withErrors($validator)->withInput();
		}
		else 
		{
			$users = new users;
			$activation_token = $users->newUser();

			if( $activation_token != false )
			{
				try
				{
					Mail::send('emails.activate_account', array("activation_token" => $activation_token), function($message) {
					    $message->to(Input::get('email'), 'Ivan Paul')->subject('ROSECO Marketing Venture account activation.');
					});
				}
				catch(Exception $e)
				{
					return Redirect::to('user/register')->with('message', '<div class="alert alert-danger text-center" style="margin: 10px 0 0 0;">Unable to send an activation link to your email. Please check your internet connection.</div>');
				}

				return Redirect::to('user/register')->with('message', '<div class="alert alert-success text-center" style="margin: 10px 0 0 0;">Thank you for registering in ROSECO Marketing Venture. Activation link has been sent to your registered email.</div>');
			}
			else
			{
				return Redirect::to('user/register')->with('message', '<div class="alert alert-notification alert-danger text-center" style="margin: 10px 0 0 0;">Unable to process your transaction. Please contact your system administrator.</div>');
			}

			
		}
	}

	public function getActivate($token)
	{
		$user = new users();
		$activated = $user->activate_user($token);

		if( $activated == true )
		{
			return Redirect::to('home')
	        		->with('login_error', '<div class="text-success" style="margin: 0 0 10px 0;">Your account has been activated. You may now login.</div>');
		}
		else
		{
			return Redirect::to('home')
	        		->with('login_error', '<div class="text-danger" style="margin: 0 0 10px 0;">Failure on account activation. Please contact your system administrator.</div>');
		}
	}

	public function getTerms()
	{
		$this->layout->content = View::make('terms');
	}

}