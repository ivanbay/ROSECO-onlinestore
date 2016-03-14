    <?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function(){

    return Redirect::to('home');

});	

/* ############ ADMIN ############ */


Route::get('admin', function(){

    return Redirect::to('admin/login');

});	

Route::controller('admin/login', "admin\LoginController");

Route::controller('admin/dashboard', "admin\DashboardController");

Route::controller('admin/home', "admin\HomeController");

Route::controller('admin/users', "admin\UsersController");

#Route::controller('admin/products', "admin\ProductsController");

Route::controller('admin/orders', "admin\OrdersController");

Route::controller('admin/report', "admin\ReportController");


/* ############ CUSTOMER ############ */

Route::controller('login', 'LoginController');

Route::controller('home', 'HomeController');

#Route::controller('product', 'ProductController');

Route::controller('order', 'OrderController');

Route::controller('cart', 'CartController');

Route::controller('user', 'userController');

Route::get('sms', function()
{
	/*$arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => "639173025624",
        "shortcode" => "292905852",
        "message_id" => str_pad(rand(), 32, '0', STR_PAD_LEFT),
        "message" => urlencode("Welcome to My Service!"),
        "client_id" => "05cff470f23b949d342b5f3b66d08bc5216f972249c2419eff945d849ab603a7",
        "secret_key" => "ef9808ba9d05d90e89a9b0b8f8e34732428f136ae681d757b65afeb166ddfb49"
    );

    $query_string = "";
    foreach($arr_post_body as $key => $frow)
    {
        $query_string .= '&'.$key.'='.$frow;
    }

    $URL = "https://post.chikka.com/smsapi/request";

    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);

    exit(0);*/

    Chikka::send('Welcome to Chikka!', '639173025624');
});


/* ########### COMMON ############ */
Route::post('delete', 'commonController@delete');


Route::get('logout', function(){

	DB::table('cart')
		->where('id', Auth::user()->id)
		->where('processed', '0')
		->delete();

  	Auth::logout();
    return Redirect::to('/');

});

	


