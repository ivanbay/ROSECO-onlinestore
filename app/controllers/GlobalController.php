<?php

/**
* 
*/
class GlobalController extends BaseController
{
	
	public function listCategories()
	{
		$categories = DB::table('category')->get();

		return $categories;
	}

}