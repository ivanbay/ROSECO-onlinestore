<?php

namespace admin;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;
use \orders;


class DashboardController extends \BaseController
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
		$orders = new orders();
		$orderList = $orders->getAllOrders('New');

		/*print("<pre>" . print_r($orderList, 1) . "</pre>");
		return "asd";*/

		$this->layout->content = View::make('admin.dashboard')->with('new_orders', $orderList);
	}

}