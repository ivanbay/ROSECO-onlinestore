<?php

class CommonController extends BaseController {

    public function delete() {

        $table = Input::get('table');
        $ids = Input::get('ids');

        switch ($table) {
            case 'products':
                $id_name = 'product_id';
                break;

            default:
                $id_name = 'id';
                break;
        }

        try {
            if (is_array($ids)) {
                DB::table($table)
                        ->wherein($id_name, $ids)
                        ->delete();
            } else {
                DB::table($table)
                        ->where($id_name, $ids)
                        ->delete();
            }

            return "true";
        } catch (\Exception $e) {
            return "Delete unsuccessfull. Please try again.";
        }
    }

    public function countNewOrders() {
        $count = DB::table('orders')->where('status', 'New')->count();
        return $count;
    }

}
