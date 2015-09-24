<?php

namespace admin;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\URL;


class LoginController extends \BaseController
{

	protected $layout = "admin.layouts.master";

	public function __construct(){

		$this->beforeFilter(function(){
            if(Auth::check()) {
                return Redirect::to('admin/dashboard');
            }
        });

	}

	public function getIndex()
	{
		$this->layout->content = View::make('admin.login');
	}

	public function postIndex()
	{	

		$validator = Validator::make(
				Input::get(),
				array(
					'username'  => 'required',
					'password'	=> 'required'
				)
			);

		if( $validator->fails() )
		{
			return Redirect::to('admin/login')->withErrors($validator);
		}


		if(Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {	

			if( Auth::user()->user_role == '1' )
			{
				return Redirect::to('admin/dashboard');
			}
			else
			{
				Auth::logout();
				return Redirect::to('admin/login')
	        		->with('message', '<div class="alert alert-danger text-center">You do not have privilege in this section.</div>')
	        		->withInput();
			}
			
		} else {

		    return Redirect::to('admin/login')
	        		->with('message', '<div class="alert alert-danger text-center">Your <strong>username/password</strong> combination is incorrect.</div>')
	        		->withInput();
			
		}
	}

}