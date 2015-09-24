<?php


/**
* 
*/
class CartController extends BaseController
{
	
	protected $layout = "layouts.master";

	public function __construct(){
		$this->beforeFilter(function(){
            if(!Auth::check()) {
                return Redirect::to('home')->with('login_error', '<div class="alert alert-danger text-center">Your session has expired. Please login to continue.</div>');
            }
        });
	}

	public function getIndex()
	{

		$order = new orders();
		$list = $order->listOrders();

		/*print("<pre>" . print_r($users_info, 1) . "</pre>");
		return "asd";*/

		$this->layout->content = View::make('cart')->with('orders', $list);
	}

	public function listItems()
	{
		$order = new orders();
		$list = $order->listOrders();

		return $list;
	}

	public function postDelete()
	{
		$order = new orders();
		$order->deleteOrders(Input::get('delete_order'));

		return Redirect::to('cart')
				->with('message', '<div class="alert alert-success alert-notification">Order(s) has been successfully removed from your cart.</div>')
        		->withInput();
	}

}