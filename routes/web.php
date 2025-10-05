<?php

use Illuminate\Support\Facades\Route;
include_once("admin.php");
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/admin/user', function () {
    return view('admin.user.index');
});
Route::get('/admin/permissao', function () {
    return view('admin.permissao.index');
});
Route::get('/admin/funcao', function () {
    return view('admin.funcao.index');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\Admin\DashboardController@dashboard']);

});
