<?php


class HomeController extends BaseController
{

	protected $layout = "layouts.master";

	public function getIndex()
	{

		$products 	= new products();
		$list 		= $products->listAllProducts();

		/*print("<pre>" . print_r($list, 1) . "</pre>");
		return "asd";*/

		$this->layout->content = View::make('home')->with('products', $list);
		
	}

}