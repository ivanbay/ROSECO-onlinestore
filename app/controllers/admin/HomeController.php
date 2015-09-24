<?php

namespace admin;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;


class HomeController extends \BaseController
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
		$this->layout->content = View::make('admin.home');
	}

}