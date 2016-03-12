<?php

namespace admin;

use \Auth;
use \View;
use \orders;
use \Redirect;
use \Response;

class OrdersController extends \BaseController {

    protected $layout = "admin.layouts.master";

    public function __construct() {
        $this->beforeFilter(function() {
            if (!Auth::check()) {
                return Redirect::to('admin/login')->with('message', '<div class="alert alert-danger text-center">Your session has expired. Please login to continue.</div>');
            }
        });
    }

    public function getList($status) {
        $orders = new orders();
        $orderList = $orders->getAllOrders($status);

        $this->layout->content = View::make('admin.orders')->with('orders', $orderList);
    }

    public function getView($order_id) {
        $orders = new orders();
        $order = $orders->getSpecificOrderForAdminView($order_id);

        /* print("<pre>". print_r($order, 1) . "</pre>");
          return "asd"; */

        $this->layout->content = View::make('admin.viewOrder')->with('order', $order);
    }

    public function getProcess($setstatus, $order_id) {
        $orders = new orders();
        $result = $orders->changeStatus($setstatus, $order_id);

        if ($result != FALSE) {
            return Redirect::to('admin/orders/list/new')
                            ->with('message', '<div class="alert alert-success alert-notification">Transaction successful.</div>')
                            ->withInput();
        } else {
            return Redirect::to('admin/orders/list/new')
                            ->with('message', '<div class="alert alert-danger alert-notification">Transaction unsuccessful. Please report this to your system administrator.</div>')
                            ->withInput();
        }
    }

    public function postCancel() {
        $order_id = Input::get('cancel_order_id');

        $order = new orders;
        $canceled = $order->cancelOrder($order_id);

        if ($canceled == true) {
            return Redirect::to('admin/orders/list/canceled')
                            ->with('message', '<div class="alert alert-success alert-notification text-center">Order has been canceled.</div>');
        } else {
            return Redirect::to('order/list')
                            ->with('message', '<div class="alert alert-danger alert-notification text-center">Unsuccessful transaction. Please contact your system administrator.</div>');
        }
    }

    public function getGenreport() {
        $orders = new orders;
        $list = $orders->genReport();

        $records = array();

        foreach ($list as $value) {
            $records[] = array(date('F', mktime(0, 0, 0, $value->month, 10)), $value->count);
        }

        #print("<pre>" . print_r($records, 1) . "</pre>");
        return Response::json($records);
    }

}
