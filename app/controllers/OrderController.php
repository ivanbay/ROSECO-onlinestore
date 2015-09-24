<?php

/**
* 
*/
class OrderController extends BaseController
{
	
	protected $layout = 'layouts.master';

	public function __construct(){
		$this->beforeFilter(function(){
            if(!Auth::check()) {
                return Redirect::to('home')->with('login_error', '<div class="alert alert-danger text-center">Your session has expired. Please login to continue.</div>');
            }
        });
	}
	
	public function getList()
	{

		$orders = new orders();
		$orderList = $orders->getAllOrdersForSpecificUser();

		/*print("<pre>". print_r($users_info, 1) . "</pre>");
		return "asd";*/

		$this->layout->content = View::make('orderList')->with('orders', $orderList);
	}

	public function postNew()
	{
		$prod_id 	= Input::get('product_id');
		$name 		= Input::get('name');
		$price		= Input::get('price');
		$qty 		= Input::get('qty') != '' ? Input::get('qty') : 1;
		$stocks		= Input::get('stocks');
		$client_ip 	= Request::getClientIp();

		if( $qty > $stocks )
		{
			 return Redirect::to('product/view/' . $prod_id)
	        		->with('message', '<div class="alert alert-danger alert-notification">Lock of stocks. Stock(s) available: '.$stocks.'</div>')
	        		->withInput();
		}

		$order = new orders();
		$store = $order->storeOrder(Input::get());

		if( $store != FALSE )
		{
			return Redirect::to('cart')
					->with('message', '<div class="alert alert-success alert-notification">New order successfully added to your cart.</div>')
	        		->withInput();
		}
		else
		{
			return Redirect::to('cart')
					->with('message', '<div class="alert alert-danger alert-notification">Transaction unsuccessful. Please report this to your system administrator.</div>')
	        		->withInput();
		}
		
	}	

	public function countOrders()
	{
		$order = new orders();
		$order_count = $order->countOrders();

		return $order_count;
	}

	public function getForm()
	{
		$user = new users();
		$users_info = $user->getUser(Auth::user()->id);

		$this->layout->content = View::make('orderForm')->with('user', $users_info);
	}

	public function getView($order_id)
	{

		$orders = new orders;
		$summary = $orders->getSpecificOrder($order_id);

		/*print("<pre>". print_r($summary, 1) . "</pre>");
		return "asd";*/

		/*print_r(DB::getQueryLog());

		return "asd";*/

		$this->layout->content = View::make('viewOrder')->with('order', $summary);
	}	

	public function postSave()
	{
		
		$validator = Validator::make(
				Input::get(),
				array(
					'last_name'		=> 'required',
					'first_name'	=> 'required',
					'mobile'		=> 'required|numeric',
					'email'			=> 'required',
					'delivery_date'	=> 'required',
					'house_no'		=> 'required',
					'street'		=> 'required',
					'city'			=> 'required',
					'province'		=> 'required',
					'zip_code'		=> 'required'
				)
			);

		if( $validator->fails() )
		{
			return Redirect::to('order/form')
		        		->withErrors($validator)
	        			->withInput();
		}

		$orders = new orders();
		$order_id = $orders->storeOrderInfo();

		if( $order_id != FALSE )
		{
			return Redirect::to('order/view/' . $order_id)
					->with('message', '<div class="alert alert-success alert-notification">New order processed successfully.</div>');
		}
		else
		{
			return Redirect::to('order/form')
					->with('message', '<div class="alert alert-danger alert-notification">Transaction unsuccessful. Please report this to your system administrator.</div>')
	        		->withInput();
		}

	}

	public function postCancel()
	{
		$order_id = Input::get('cancel_order_id');

		$order = new orders;
		$canceled = $order->cancelOrder($order_id);

		if( $canceled == true )
		{
			return Redirect::to('order/list')
					->with('message', '<div class="alert alert-success alert-notification text-center">Order has been canceled.</div>');
		}
		else
		{
			return Redirect::to('order/list')
					->with('message', '<div class="alert alert-danger alert-notification text-center">Unsuccessful transaction. Please contact your system administrator.</div>');
		}
		
	}

}