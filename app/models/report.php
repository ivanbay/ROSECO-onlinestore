<?php

class report
{

	public function getReport()
	{
		$data = array();

		$report = DB::table('cart')
					->selectRaw('prod_id, prod_name, SUM(price * qty) AS total, DATE(date_order) AS date_order')
					->whereBetween('date_order', array(
						CustomHelpers::format_db_date(Input::get('date_from')), 
						CustomHelpers::format_db_date(Input::get('date_to')), 
						)
					)
					->orderBy('date_order', 'asc')
					->groupBy('prod_id')
					->get();

		/*$query = DB::getQueryLog();
		print_r($query, 1);*/

		foreach( $report as $values )
		{
			 $data['date'][] = $values->date_order;
			 $data['main_record'][] = $values;
		}


		return $data;
	}
}