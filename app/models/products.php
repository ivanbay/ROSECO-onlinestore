<?php

class products
{

	public function listProducts()
	{
		try
		{
			$list = DB::table('products')
						->join('category', 'products.category', '=', 'category.category_id')
						->get();
		}
		catch(Exception $e)
		{

		}

		return $list;
	}

	public function listSpecificProducts($prod_id)
	{
		$data = array();

		try
		{

			$list = DB::table('products')
						->leftjoin('product_img', 'products.product_id', '=', 'product_img.product_id')
						->join('category', 'products.category', '=', 'category.category_id')
						->select(
							array(
								'products.product_id as product_id',
								'products.name as name',
								'products.description as description',
								'products.category as category',
								'category.category_name as category_name',
								'products.dimensions as dimensions',
								'products.cost as cost',
								'products.stock as stock',
								'products.status as status',
								'products.customizable as customizable',
								'product_img.filename as filename',
								'products.colors as colors'
							)
						)
						->where('products.product_id', '=', $prod_id)
						->get();

			#print("<pre>" . print_r($list, 1) . "</pre>");

			$data['product_id'] 	= $list[0]->product_id;
			$data['name']			= $list[0]->name;
			$data['description']	= $list[0]->description;
			$data['category_id']	= $list[0]->category;
			$data['category']		= $list[0]->category_name;
			$data['dimensions']		= $list[0]->dimensions;
			$data['cost']			= $list[0]->cost;
			$data['stock']			= $list[0]->stock;
			$data['status']			= $list[0]->status;
			$data['customizable']	= $list[0]->customizable;
			$data['colors']			= $list[0]->colors;

			foreach( $list as $product_img )
			{
				$data['product_img'][] = $product_img->filename;
			}
			
			$parts = DB::table('product_parts')
						->join('parts_choices', 'product_parts.part_id', '=', 'parts_choices.part_id')
						->where('product_parts.prod_id', '=', $prod_id)
						->get();

			#print("<pre>" . print_r($parts, 1) . "</pre>");

			foreach( $parts as $part )
			{
				$data['parts'][$part->part_id][$part->part_name][$part->choice_id] = array(
						'filename'	=>	$part->choices_filename, 
						'name'		=>	$part->choice_name, 
						'cost'		=>	$part->choice_cost
					);
			}

		}
		catch(Exception $e)
		{

		}

		return $data;
	}

	public function listAllProducts()
	{
		$data = array();
		$product_images = array();
		$product_parts = array();

		try
		{

			$list = DB::table('products')
						->leftjoin('product_img', 'products.product_id', '=', 'product_img.product_id')
						->join('category', 'products.category', '=', 'category.category_id')
						->leftjoin('product_parts', 'products.product_id', '=', 'product_parts.prod_id')
						->leftjoin('parts_choices', 'product_parts.part_id', '=', 'parts_choices.part_id')
						->select(
							array(
								'products.product_id as product_id',
								'products.name as name',
								'products.description as description',
								'products.category as category',
								'category.category_name as category_name',
								'products.dimensions as dimensions',
								'products.cost as cost',
								'products.stock as stock',
								'products.status as status',
								'products.customizable as customizable',
								'product_img.filename as filename',
								'product_parts.part_id as part_id',
								'product_parts.part_name as part_name',
								'parts_choices.choice_id as choice_id',
								'parts_choices.choices_filename as choices_filename'
							)
						)->get();

			foreach( $list as $value )
			{

				$data[$value->category_name][$value->product_id] = array(
						'name' 				=> $value->name,
						'description' 		=> $value->description,
						'category_id'		=> $value->category,
						'dimensions'		=> $value->dimensions,
						'cost'				=> $value->cost,
						'stock'				=> $value->stock,
						'status'			=> $value->status,
						'customizable'		=> $value->customizable,
						'product_image'		=> $value->filename

					);

			}

			/*print("<pre>" . print_r($data, 1) . "</pre>");

			print("<pre>" . print_r($product_parts, 1) . "</pre>");

			print("<pre>" . print_r($list, 1) . "</pre>");*/


		}
		catch(Exception $e)
		{

		}

		return $data;
	}

	public function newProduct($inputs)
	{

		$name 			= $inputs['product_name'];
		$desc			= $inputs['product_desc'];
		$dimensions		= $inputs['dimensions'];
		$category 		= $inputs['category'];
		$cost 			= $inputs['product_cost'];
		$stock 			= $inputs['stock'];
		$customizable	= isset($inputs['customizable']) ? $inputs['customizable'] : '0';
		$colors 		= !empty($inputs['colors']) ? $inputs['colors'] : NULL;

		try
		{
			$prod_id = DB::table('products')
						->insertGetId(
							array(
								'name'	=> $name,
								'description'	=> $desc,
								'dimensions'	=> $dimensions,
								'category'		=> $category,
								'cost'			=> $cost,
								'stock'			=> $stock,
								'customizable'	=> $customizable,
								'colors'		=> $colors
							)
						);
		}	
		catch(Exception $e)
		{

		}

		return $prod_id;

	}

	public function saveUpdate($inputs)
	{
		$prod_id 		= $inputs['prod_id'];
		$name 			= $inputs['product_name'];
		$desc 			= $inputs['product_desc'];
		$dimensions 	= $inputs['dimensions'];
		$category 		= $inputs['category'];
		$prod_cost 		= $inputs['product_cost'];
		$stock 			= $inputs['stock'];
		$customizable 	= $inputs['customizable'];
		$colors			= !empty( $inputs['colors'] ) ? $inputs['colors'] : NULL;

		try
		{
			DB::table('products')
				->where('product_id', $prod_id)
				->update(
					array(
						'name'			=> $name,
						'description'	=> $desc,
						'category'		=> $category,
						'dimensions'	=> $dimensions,
						'cost'			=> $prod_cost,
						'stock'			=> $stock,
						'colors'		=> $colors
						//'customizable'	=> $customizable
					)
				);
				
		}
		catch(Exception $e)
		{
			return false;
		}

		return true;

	}

	public function countRows($table, $field, $id)
	{
		$rows = DB::table($table)->where($field, $id)->count();
		return $rows;
	}

	public function productImage($data)
	{

		try
		{
			DB::table('product_img')
				->insert(
					array(
						'product_id'	=> $data['prod_id'],
						'filename'		=> $data['filename'],
						'orig_filename'	=> $data['orig_filename'],
						'extension'		=> $data['extension']
					)
				);
		}
		catch(exception $e)
		{
			return false;
		}

		return true;

	}

	public function dynamicStoreDataRetId($table, $data)
	{
		$records = array();

		foreach( $data as $key => $value )
		{
			$records[$key] = $value;
		}

		$id = DB::table($table)->insertGetId($records);
		try
		{
			
		}
		catch(exception $e)
		{
			return false;
		}

		return $id;
	}

	public function deleteItems($table, $field, $values)
	{
		DB::table($table)->whereIn($field, $values)->delete();
	}

}