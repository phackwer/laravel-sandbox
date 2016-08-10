<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return response()->json(['status' => 'OK']);
});

$dsp = DIRECTORY_SEPARATOR;

/**
 * Automatically register all controllers routes
 * Otherwise you would have to declare each one like this:
 *
 * Route::resource('currency', 'CurrencyController');
 * Route::resource('event', 'EventController');
 * Route::resource('exchangerate', 'ExchangeRateController');
 * Route::resource('partner', 'PartnerController');
 * ... (imagine 50 controllers?!?!?!)
 *
 * @var [type]
 */
$controllers = glob(app_path().$dsp.'Http'.$dsp.'Controllers'.$dsp.'*');
foreach ($controllers as $controller) {
    if (is_file($controller)) {
        $controller = explode(DIRECTORY_SEPARATOR, $controller);
        $controllerName = str_replace('Controller.php', '', $controller[count($controller) - 1]);
        Route::resource(strtolower($controllerName), $controllerName.'Controller');
    }
}
