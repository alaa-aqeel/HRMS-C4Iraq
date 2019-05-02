<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


/**
 * @api  {POST}  /login  Users login 
 */
Route::POST("/login","API\ControllerLogIn@index");


/**
 * @api  {POST}  /register  Users register  
 */
Route::POST("/register","API\ControllerRegister@index");


Route::group(["prefix"=>'member','middleware'=> ["jwt.auth","isactive"]], function(){

    /*
     * @api {GET} /member/
     *
     * @return Member-Info 
     */
    Route::get("","API\ControllerMember@index" );

    /*
     * @api {POST} /member/mpass   
     *  
     * @body* { new_password, curent_password  } 
     * 
     */
    Route::post("mpass","API\ControllerMember@edit_password" );
    Route::post("profile/update","API\ControllerProfileUsers@update");
    
    Route::get("team","API\ControllerMangers@team_governorate");
    Route::get("path","API\ControllerMangers@team_path");


    /*
     * @api /member/paths 
     * 
     * @return All-Paths
     * 
     */
    Route::get("paths","API\ControllerPath@getPaths");

    Route::resource("userpath","API\ControllerPath");
    Route::resource("project","API\ControllerUserProject");

    Route::resource("profile","API\ControllerProfileUsers");


});