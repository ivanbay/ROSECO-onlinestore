<?php

namespace admin;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;
use \Users;


class UsersController extends \BaseController
{

	protected $layout = "admin.layouts.master";

	public function __construct(){
		$this->beforeFilter(function(){
            if(!Auth::check()) {
                return Redirect::to('admin/login')->with('message', '<div class="alert alert-danger text-center">Your session has expired. Please login to continue.</div>');
            }
        });
	}

	public function getIndex()
	{
		$user = new Users;
		$list = $user->listUsers();

		$this->layout->content = View::make('admin.users')->with('list', $list);
	}

	public function postNew()
	{
		
		$validator = Validator::make(
				Input::get(),
				array(
					'fname'			=> 'required',
					'mname'			=> 'required',
					'lname'			=> 'required',
					'username'		=> 'required',
					'password'		=> 'required|confirmed',
				)
			);

		if ($validator->fails())
		{	
		   return Redirect::to('admin/users')->withErrors($validator);
		}
		else if( Input::get('usertype') == '' )
		{
			return Redirect::to('admin/users')->with('message', '<div class="alert alert-danger"><b>Error(s) encounter:</b> User type field is required.</div>');
		}
		else 
		{
			$users = new users;
			$newuser = $users->newUser();

			return $newuser;
		}
	}
}