<?php

class orders
{

	protected $userid;

	public function __construct()
	{
		 $this->userid = Auth::check() ? Auth::user()->id : Request::getClientIp();
	}
	
	public function storeOrder()
	{
		$prod_id 	= Input::get('product_id');
		$name 		= Input::get('name');
		$price		= Input::get('price');
		$qty 		= Input::get('qty') != '' ? Input::get('qty') : 1;
		$stocks		= Input::get('stocks');

		try
		{
			$order_id = DB::table('cart')
							->insertGetId(
								array(
									'userid' 		=> $this->userid,
									'prod_id'		=> $prod_id,
									'prod_name'		=> $name,
									'price'			=> $price,
									'qty'			=> $qty
								)
							);

			if( !empty(Input::get()['parts']) )
			{
				foreach( Input::get('parts') as $part_id => $choice_id )
				{

					DB::table('order_custom_parts')
						->insert(
							array(
								'order_id'	=> $order_id,
								'part_id'	=> $part_id,
								'choice_id'	=> $choice_id
							)
						);

				}
			}

		}
		catch(Exception $e)
		{
			$order_id = FALSE;
		}

		return $order_id;

	}

	public function countOrders()
	{
		$count = DB::table('cart')->where('userid', $this->userid)->where('order_id', NULL)->count();
		return $count;
	}

	public function listOrders()
	{	

		$data = array();
		$part_name = array();
		$id = '';

		$orders = DB::table('cart')
					->selectRaw('cart.id, cart.client_ip, cart.prod_id, cart.prod_name, cart.price, cart.qty, product_parts.part_name, parts_choices.choice_name, parts_choices.choice_cost')
					->leftjoin('order_custom_parts', 'cart.id', '=', 'order_custom_parts.order_id')
					->leftjoin('product_parts', 'order_custom_parts.part_id', '=', 'product_parts.part_id')
					->leftjoin('parts_choices', 'product_parts.part_id', '=', 'parts_choices.part_id')
					->where("userid", $this->userid)
					->where('cart.order_id', NULL)
					->get();

		/*print("<pre>" . print_r($orders, 1) . "</pre>");
		print_r(DB::getQueryLog());*/

		foreach( $orders as $order )
		{
			
			if( $id != $order->id )
			{
				$part_name = array();
			}

			$part_name[$order->part_name] = array(
					'choice_name'	=> $order->choice_name,
					'choice_cost'	=> $order->choice_cost
				);

			$data[$order->id] = array(
					'userid' 		=> $this->userid,
					'prod_id'		=> $order->prod_id,
					'prod_name'		=> $order->prod_name,
					'price'			=> $order->price,
					'qty'			=> $order->qty,
					'part_name'		=> $part_name
				);

			$id = $order->id;
		}
		
		return $data;
	}

	public function getAllOrdersForSpecificUser()
	{
		$orders = DB::table('orders')->where('userid', $this->userid)->get();

		return $orders;
	}

	public function getAllOrders($status)
	{
		$status = ucwords($status);
		$orders = DB::table('orders')->where('status', $status)->get();

		return $orders;
	}

	public function getSpecificOrderForAdminView($order_id)
	{
		$data = array();
		$part_name = array();
		$record = array();
		$id = '';

		$orders = DB::table('cart')
					->selectRaw('orders.*, cart.id as item_id, cart.userid, cart.prod_id, cart.prod_name, cart.price, cart.qty, product_parts.part_name, parts_choices.choices_filename, parts_choices.choice_name, parts_choices.choice_cost')
					->leftjoin('orders', 'cart.order_id', '=', 'orders.id')
					->leftjoin('order_custom_parts', 'cart.id', '=', 'order_custom_parts.order_id')
					->leftjoin('product_parts', 'order_custom_parts.part_id', '=', 'product_parts.part_id')
					->leftjoin('parts_choices', 'product_parts.part_id', '=', 'parts_choices.part_id')
					//->where("orders.userid", $this->userid)
					->where('orders.id', $order_id)
					->where('cart.processed', '1')
					->get();

		if( !empty($orders) )
		{

			$record['order_info'] = array(
					'order_id'				=> $orders[0]->id,
					'userid' 				=> $this->userid,
					'lastname'				=> $orders[0]->lastname,
					'firstname'				=> $orders[0]->firstname,
					'middlename'			=> $orders[0]->middlename,
					'mobile'				=> $orders[0]->mobile,
					'landline'				=> $orders[0]->landline,
					'email'					=> $orders[0]->email,
					'delivery_date'			=> $orders[0]->delivery_date,
					'house_no'				=> $orders[0]->house_no,
					'street'				=> $orders[0]->street,
					'brgy'					=> $orders[0]->brgy,
					'city'					=> $orders[0]->city,
					'province'				=> $orders[0]->province,
					'zip_code'				=> $orders[0]->zip_code,
					'delivery_date'			=> $orders[0]->delivery_date,
					'status'				=> $orders[0]->status,
					'cancelation_reason'	=> $orders[0]->cancelation_reason
				);

		}

		foreach( $orders as $order )
		{
			
			if( $id != $order->item_id )
			{
				$part_name = array();
			}

			$part_name[$order->part_name] = array(
						'filename' 	=> $order->choices_filename,
						'choice_name'		=> $order->choice_name,
						'choice_cost'		=> $order->choice_cost
					);

			$data[$order->item_id] = array(
					'prod_id'		=> $order->prod_id,
					'prod_name'		=> $order->prod_name,
					'price'			=> $order->price,
					'qty'			=> $order->qty,
					'part_name'		=> $part_name
				);

			$id = $order->item_id;
		}

		$record['items'] = $data;
		
		return $record;
	}


	public function getSpecificOrder($order_id)
	{
		$data = array();
		$part_name = array();
		$record = array();
		$id = '';

		$orders = DB::table('cart')
					->selectRaw('orders.*, cart.id as item_id, cart.userid, cart.prod_id, cart.prod_name, cart.price, cart.qty, product_parts.part_name, parts_choices.choices_filename, parts_choices.choice_name, parts_choices.choice_cost')
					->leftjoin('orders', 'cart.order_id', '=', 'orders.id')
					->leftjoin('order_custom_parts', 'cart.id', '=', 'order_custom_parts.order_id')
					->leftjoin('product_parts', 'order_custom_parts.part_id', '=', 'product_parts.part_id')
					->leftjoin('parts_choices', 'product_parts.part_id', '=', 'parts_choices.part_id')
					->where("orders.userid", $this->userid)
					->where('orders.id', $order_id)
					->where('cart.processed', '1')
					->get();

		if( !empty($orders) )
		{

			$record['order_info'] = array(
					'order_id'		=> $orders[0]->id,
					'userid' 		=> $this->userid,
					'lastname'		=> $orders[0]->lastname,
					'firstname'		=> $orders[0]->firstname,
					'middlename'	=> $orders[0]->middlename,
					'mobile'		=> $orders[0]->mobile,
					'landline'		=> $orders[0]->landline,
					'email'			=> $orders[0]->email,
					'delivery_date'	=> $orders[0]->delivery_date,
					'house_no'		=> $orders[0]->house_no,
					'street'		=> $orders[0]->street,
					'brgy'			=> $orders[0]->brgy,
					'city'			=> $orders[0]->city,
					'province'		=> $orders[0]->province,
					'zip_code'		=> $orders[0]->zip_code,
					'delivery_date'	=> $orders[0]->delivery_date,
					'status'		=> $orders[0]->status,
					'cancelation_reason'	=> $orders[0]->cancelation_reason
				);

		}

		foreach( $orders as $order )
		{
			
			if( $id != $order->item_id )
			{
				$part_name = array();
			}

			$part_name[$order->part_name] = array(
						'filename' 	=> $order->choices_filename,
						'choice_name'		=> $order->choice_name,
						'choice_cost'		=> $order->choice_cost
					);

			$data[$order->item_id] = array(
					'prod_id'		=> $order->prod_id,
					'prod_name'		=> $order->prod_name,
					'price'			=> $order->price,
					'qty'			=> $order->qty,
					'part_name'		=> $part_name
				);

			$id = $order->item_id;
		}

		$record['items'] = $data;
		
		return $record;
	}

	public function deleteOrders($ids)
	{
		foreach( $ids as $id )
		{
			DB::table('cart')->where('id', $id)->delete();
		}
	}

	public function storeOrderInfo()
	{
		try
		{
			$order_id = DB::table('orders')
							->insertGetId(
								array(
									'userid'		=> $this->userid,
									'lastname'		=> ucwords(Input::get('last_name')),
									'firstname'		=> ucwords(Input::get('first_name')),
									'middlename'	=> ucwords(Input::get('middle_name')),
									'mobile'		=> Input::get('mobile'),
									'landline'		=> Input::get('landline'),
									'email'			=> Input::get('email'),
									'delivery_date'	=> Input::get('delivery_date'),
									'house_no'		=> Input::get('house_no'),
									'street'		=> Input::get('street'),
									'brgy'			=> Input::get('brgy'),
									'city'			=> Input::get('city'),
									'province'		=> Input::get('province'),
									'zip_code'		=> Input::get('zip_code'),
									'total'			=> Input::get('total')
								)
							);

			DB::table('cart')
				->where('userid', $this->userid)
				->where('processed', '0')
				->update(
					array(
						'order_id' 	=> $order_id,
						'processed'	=> '1'
					)
				);
		}
		catch(Exception $e)
		{
			return false;
		}

		return $order_id;

	}

	public function changeStatus($status, $order_id)
	{
		switch ($status) {
			case 'approve':
				$status = "Approved";
				break;
			
			case 'disapprove':
				$status = "Disapproved";
				break;

			case 'delivered':
				$status = "Delivered";
				break;

			case 'cancel':
				$status = "Canceled";
				break;

			case 'delete':
				$status = "Deleted";
				break;
		}

		try
		{
			DB::table('orders')->where('id', $order_id)->update(array('status' => $status));
		}
		catch(Exception $e)
		{
			return false;
		}

		return true;
	}


	public function cancelOrder($order_id)
	{
		try
		{
			DB::table('orders')->where('id', $order_id)->update(
					array(
						'status' 				=> 'Canceled',
						'cancelation_reason'	=> Input::get('cancelation_reason')
					)
				);

			return true;
		}
		catch( Exception $e )
		{
			return false;
		}
	}

	public function genReport()
	{
		$orders = DB::table('orders')
						->selectRaw('MONTH(date_ordered) as month, COUNT(id) as count')
						->whereRaw("status = 'Delivered' AND YEAR(date_ordered) = YEAR(NOW())")
						->groupBy(DB::raw('MONTH(date_ordered)'))
						->get();
		return $orders;
	}

	public function genBarReport()
	{
		$orders = DB::table('orders')
						->selectRaw('MONTH(date_ordered) as month, COUNT(id) as count, status')
						->whereRaw("YEAR(date_ordered) = YEAR(NOW()) AND STATUS != 'Deleted' AND STATUS != 'New'")
						->groupBy(DB::raw('MONTH(date_ordered), status'))
						->get();
		return $orders;
	}

}