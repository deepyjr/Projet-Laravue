<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

Route::get('client/afficherInformations', 'clientController@afficherInformations')->name('client.afficherInformations');
Route::resource('clients', 'clientController');
Route::resource('users', 'userController');
Route::resource('superAdmins', 'superAdminController');
Route::resource('admins', 'adminController');
Route::get('commandes/indexCommandesByClientId/{clientId}', 'commandeController@indexCommandesByClientId')->name('commandes.indexCommandesByClientId');
Route::resource('commandes', 'commandeController');
Route::get('campus/indexByClientId/{clientId}', 'campusController@indexByClientId')->name('campus.indexByClientId');
Route::resource('campus', 'campusController');
Route::get('sites/indexByCampusId/{campusId}', 'siteController@indexByCampusId')->name('site.indexByCampusId');
Route::resource('sites', 'siteController');
Route::get('objets/indexBySiteId/{siteId}', 'objetController@indexBySiteId')->name('objet.indexBySiteId');
Route::resource('objets', 'objetController');
Route::resource('robots', 'robotController');
Route::resource('notifications', 'notificationController');
Route::resource('produits_menagers', 'produits_menagerController');
Route::resource('outils_menagers', 'outils_menagerController');
Route::get('dashbord/getDataForDashbord/{clientId}', 'dashbordController@getDataForDashbord')->name('dashbord.getDataForDashbord');