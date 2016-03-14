<?php

/**
 * 
 */
class productController extends baseController {

    protected $layout = 'layouts.master';

    public function __construct() {
        $this->beforeFilter(function() {
            if (!Auth::check()) {
                return Redirect::to('home')->with('login_error', '<div class="alert alert-danger text-center">Your session has expired. Please login to continue.</div>');
            }
        });
    }

    public function getView($prod_id) {
        $product = new products();
        $list = $product->listSpecificProducts($prod_id);

        /* print("<pre>" . print_r($list, 1) . "</pre>");
          return "asd"; */

        $this->layout->content = View::make('view_product')->with('products', $list);
    }

}
