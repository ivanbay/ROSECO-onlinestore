<?php

namespace admin;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Str;
use \Users;
use \Products;


class ProductsController extends \BaseController
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

		$product = new products();
		$list = $product->listProducts();

		$this->layout->content = View::make('admin.products')->with('products', $list);
	}

	public function getNew()
	{
		$this->layout->content = View::make('admin.newproducts');
	}

	public function getEdit($prod_id)
	{

		$product = new products();
		$list = $product->listSpecificProducts($prod_id);

		#print("<pre>" . print_r($list, 1) . "</pre>");
		#return "asd";
		$this->layout->content = View::make('admin.editproducts')->with('products', $list);
	}

	public function postSave()
	{
		$a = 1;
		$product_images = Input::file('product_image');
		$image_arr = array();
		$orig_names = array();
		$destinationPath = public_path().'\\product_images\\';
		$choicesDestinationPath = public_path().'\\choices_images\\';

		print("<pre>" . print_r(Input::all(), 1) . "</pre>");
		return "asd";

		$validator = Validator::make(
							Input::get(),
							array(
								'product_name' 	=> 'required',
								'dimensions'	=> 'required',
								'product_cost'	=> 'required',
								'stock'			=> 'required|numeric'								
							)
						);

		if( $validator->fails() )
		{
			return Redirect::to('admin/products/new')->withErrors($validator)->withInput();
		}
		elseif( Input::get('category') == '0' )
		{
			return Redirect::to('admin/products/new')->withErrors("ERROR")->withInput();
		}

		try
		{
		
			$product = new products();
			$prod_id = $product->newProduct(Input::get());


			/* working on product images */
			if( isset(Input::all()['product_image']) && $prod_id != NULL )
			{
				foreach($product_images as $product_image) {

			    	if( $product_image != null ){

				    	if( $product_image->isValid() )
				    	{
				    		$image_arr[$a] = $product_image->getClientOriginalName();
				    		$orig_name = Str::lower(pathinfo($product_image->getClientOriginalName(), PATHINFO_FILENAME));
				    		$extension = $product_image->getClientOriginalExtension(); 

				    		$new_filename = $prod_id . "_" . $a . "." . $extension; 

				    		$data = array(
				    			'prod_id'		=> $prod_id,
				    			'filename'		=> $new_filename,
				    			'orig_filename'	=> $orig_name,
				    			'extension'		=> $extension
				    		);

				    		$result = $product->productImage($data);

				    		if( $result == true )
				    		{
				    			$product_image->move($destinationPath, $new_filename); 
				    		}

				    	}

				    }
			    	
			    	$a++;
			    }
			}

		    /* WORKING WITH PARTS AND PARTS CHOICES */

		    if( isset(Input::all()['part_name']) )
		    { 
		    	foreach( Input::get('part_name') as $part_key => $part_name )
		    	{
		    		
		    		if( $part_name != NULL && count(Input::file('part_choices')[$part_key]) != 0 )
		    		{	
		    			$data = array(
		    				'prod_id'	=> $prod_id,
		    				'part_name'	=> $part_name
		    			);

		    			$part_id = $product->dynamicStoreDataRetId('product_parts', $data);

		    			/* successfully stored in the database */
		    			if( $part_id != FALSE )
		    			{
		    				$b = 1;
		    				foreach( Input::file('part_choices')[$part_key] as $key => $choice_img ) //image
		    				{
		    					if( $choice_img	!= NULL )
		    					{
		    						
		    						$extension = $choice_img->getClientOriginalExtension(); 
		    						$new_filename = $prod_id . "_" . $part_id . "_" . $b . "." . $extension;

		    						$data = array(
		    							'part_id' 			=> $part_id,
		    							'choices_filename'	=> $new_filename,
		    							'choice_name'		=> Input::get('part_choices_name')[$part_key][$key],
		    							'choice_cost'		=> Input::get('part_choices_cost')[$part_key][$key]
		    						);

		    						$choice_id = $product->dynamicStoreDataRetId('parts_choices', $data);

		    						if( $choice_id != FALSE )
		    						{
		    							$choice_img->move($choicesDestinationPath, $new_filename);
		    						}

		    					}
		    					$b++;
		    				}
		    			}
		    		}
		    	}
		    }
		}
		catch(Exception $e)
		{
			return Redirect::to('admin/products')->with('message', '<div class="alert alert-danger text-center">Something\'s went wrong. Please report this to your system administrator.</div>');
		}


	    return Redirect::to('admin/products')->with('message', '<div class="alert alert-success alert-notification text-center">Transaction successful!</div>');
	}

	public function postUpdate()
	{
		
		$prod_id 				= Input::get('prod_id');
		$prod_image 			= Input::file('product_image');
		$destinationPath 		= public_path().'\\product_images\\';
		$choicesDestinationPath = public_path().'\\choices_images\\';

		$validator 		= Validator::make(
							Input::get(),
							array(
								'product_name' 	=> 'required',
								'dimensions'	=> 'required',
								'product_cost'	=> 'required',
								'stock'			=> 'required|numeric'								
							)
						);

		/*print("<pre>" . print_r(Input::all(), 1) . "</pre>");
		return "Asd";*/

		if( $validator->fails() )
		{
			return Redirect::to('admin/products/edit/'.$prod_id)->withErrors($validator)->withInput();
		}
		elseif( Input::get('category') == '0' )
		{
			return Redirect::to('admin/products/edit/'.$prod_id)->withErrors("ERROR")->withInput();
		}

		try
		{
			
			$product 	= new products();
			$update_res = $product->saveUpdate(Input::get());


			/* working on product image */
			if( isset(Input::all()['product_image']) )
			{
				$count = $product->countRows('product_img', 'product_id', $prod_id);
				
				foreach( $prod_image as $image )
				{	
					$count++;

					if( $image->isValid() && $image != NULL )
				    {
						$extension = $image->getClientOriginalExtension(); 
						$orig_name = Str::lower(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
						$new_filename = $prod_id . "_" . $count . "." . $extension; 

			    		$data = array(
			    			'prod_id'		=> $prod_id,
			    			'filename'		=> $new_filename,
			    			'orig_filename'	=> $orig_name,
			    			'extension'		=> $extension
			    		);

			    		$result = $product->productImage($data);

			    		if( $result == true )
			    		{
			    			$image->move($destinationPath, $new_filename); 
			    		}
			    	}
				}

			}

			
			/* working on product choices */
			if( isset(Input::all()['part_choices']) && !isset(Input::all()['part_name']) )
			{
				
				foreach( Input::file('part_choices') as $part_id => $choices ) //image
				{
					$count = $product->countRows('parts_choices', 'part_id', $part_id);

					foreach( $choices as $key => $choice_img )
					{
						$count++;

						if( $choice_img	!= NULL )
    					{
    						
    						$extension = $choice_img->getClientOriginalExtension(); 
    						$new_filename = $prod_id . "_" . $part_id . "_" . $count . "." . $extension;

    						$data = array(
    							'part_id' 			=> $part_id,
    							'choices_filename'	=> $new_filename,
    							'choice_name'		=> Input::get('part_choices_name')[$part_id][$key],
    							'choice_cost'		=> Input::get('part_choices_cost')[$part_id][$key]
    						);

    						$choice_id = $product->dynamicStoreDataRetId('parts_choices', $data);

    						if( $choice_id != FALSE )
    						{
    							$choice_img->move($choicesDestinationPath, $new_filename);
    						}

    					}
					}
				}

			}

			if( isset(Input::all()['part_choices']) && isset(Input::all()['part_name']) )
			{
				foreach( Input::get('part_name') as $part_key => $part_name )
		    	{
		    		
		    		if( $part_name != NULL && count(Input::file('part_choices')[$part_key]) != 0 )
		    		{	
		    			$data = array(
		    				'prod_id'	=> $prod_id,
		    				'part_name'	=> $part_name
		    			);

		    			$part_id = $product->dynamicStoreDataRetId('product_parts', $data);

		    			/* successfully stored in the database */
		    			if( $part_id != FALSE )
		    			{
		    				$b = 1;
		    				foreach( Input::file('part_choices')[$part_key] as $key => $choice_img ) //image
		    				{
		    					if( $choice_img	!= NULL )
		    					{
		    						
		    						$extension = $choice_img->getClientOriginalExtension(); 
		    						$new_filename = $prod_id . "_" . $part_id . "_" . $b . "." . $extension;

		    						$data = array(
		    							'part_id' 			=> $part_id,
		    							'choices_filename'	=> $new_filename
		    						);

		    						$choice_id = $product->dynamicStoreDataRetId('parts_choices', $data);

		    						if( $choice_id != FALSE )
		    						{
		    							$choice_img->move($choicesDestinationPath, $new_filename);
		    						}

		    					}
		    					$b++;
		    				}
		    			}
		    		}
		    	}
			}

			if( Input::has('del_prod_image') )
			{
				$product->deleteItems('product_img', 'filename', Input::get('del_prod_image'));
			}

			if( Input::has('del_choices') )
			{
				$product->deleteItems('parts_choices', 'choice_id', Input::get('del_choices'));
			}

			if( Input::has('del_product_parts') )
			{
				$product->deleteItems('product_parts', 'part_id', Input::get('del_product_parts'));
			}

		}
		catch(Exception $e)
		{
			return Redirect::to('admin/products/edit/'.$prod_id)->with('message', '<div class="alert alert-danger text-center">Something\'s went wrong. Please report this to your system administrator.</div>');
		}

		
		return Redirect::to('admin/products/edit/'.$prod_id)->with('message', '<div class="alert alert-success alert-notification text-center">Transaction successful!</div>');

	}

}