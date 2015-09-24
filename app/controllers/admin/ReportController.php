<?php

namespace admin;
use \Auth;
use \View;
use \Input;
use \Report;
use \orders;
use \Redirect;
use \PDF;
use \Response;

/**
* 
*/
class ReportController extends \BaseController
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
		$this->layout->content = View::make('admin.report');
	}

	public function getGraph()
	{
		$this->layout->content = View::make('admin.reportGraph');
	}

	public function postIndex()
	{
		$report = new report();
		$result = $report->getReport();

		/*print("<pre>" . print_r($result, 1) . "</pre>");
		return "asd";*/
	
		$this->layout->content = View::make('admin.report')->with('report', $result);
		
	}

	public function getGenreport()
	{
		$orders = new orders;
		$list = $orders->genBarReport();

		$records = array();
		$status = array();
		$ret_values = array();
		
		

		/*foreach($list as $value)
		{	
			$month_val = array();

			foreach($months as $month)
			{
				if( $value->month == $month )
				{
					$month_val[] = $value->count;
				}
				else
				{
					$month_val[] = 0;
				}
			}
			$records[$value->status] = $month_val; 
		}*/

		foreach( $list as $value )
		{
			$status[$value->status][$value->month] = $value->count;
		}

		foreach( $status as $stat => $stat_val )
		{
			$months = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);

			foreach( $stat_val as $rec_month => $count )
			{
				$months[$rec_month] = $count;
				$records[$stat] = $months;
			}
		}

		foreach( $records as $status => $values )
		{
			$ret_values[$status] = array_values($values);
		}

		/*print("<pre>" . print_r($status, 1) . "</pre>");

		print("<pre>" . print_r($ret_values, 1) . "</pre>");*/
		
		return Response::json($ret_values);
	}

	public function postDownload()
	{
		$report = new report();
		$result = $report->getReport();

		$html = '<div class="row text-center" style="margin: 0 0 50px 0; text-align: center;">';
		$html .= '<h2>ROSECO Marketing Venture</h2>';
		$html .= '<div style="margin: 0 0 30px 0;">Report range: <b>'.date("M d, Y", strtotime(Input::get("date_from"))).'</b> to <b>'.date("M d, Y", strtotime(Input::get("date_to"))).'</b></div>';
		$html .= '<table border="1" align="center" style="min-width: 500px; font-size: 10px;" cellpadding="2" cellspacing="0" class="table table-bordered">';
			
		if( !empty($result) )
		{

			$html .= '<tr>
						<th rowspan="2" class="text-center">Product Name</th>
						<th colspan="'.count(array_unique($result['date'])).'" class="text-center">Total</th>
					</tr>
					<tr>';

			foreach( array_unique($result['date']) as $date )
			{
				$html .= '<th class="text-center">'.date("M d, Y", strtotime($date)).'</th>';
			}

			$html .= '</tr>';

			$totals = array();

			foreach( $result['main_record'] as $value)
			{

				$html .= '<tr>
							<td class="text-left">'.$value->prod_name.'</td>';
				
				foreach( array_unique($result['date']) as $date )
				{
				
					if( $date == $value->date_order )
					{
						$html .= '<td class="text-left">Php '.number_format($value->total, 2, '.', ',').'</td>';
						$totals[$date][] = $value->total;
					}
					else
					{ 
					 	$html .= '<td>&nbsp;</td>';
					}

				}
				
				$html .= '</tr>';

			}

			$html .= '<tr>
						<td class="text-left">
							<b>Total:</b>
						</td>';

						foreach( array_unique($result['date']) as $date )
						{
							$html .= '<td class="text-left">Php '.number_format(array_sum($totals[$date]), 2, '.', ',').'</td>';
						}


			$html .= '</tr>';

		}
		else
		{
			$html .= '<div class="alert alert-danger text-center">No records found. Please try to modify your filter.</div>';
		}

		$html .= '</table></div>';
		

        $filename = "report_" . date('m-d-y') . ".pdf";
    	return PDF::load($html, 'A4', 'portrait')->show();
	}

}