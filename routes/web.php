<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Role::create(['name' => 'author']);
    // Role::create(['name' => 'admin']);
    // Role::create(['name' => 'reader']);
    // Permission::create(['name' => 'Administer roles and permissions']);
    return view('welcome');
});

Auth::routes();

// Routes for roles

Route::resource('roles', 'Admin\RoleController');
Route::post('role/update/{id}', 'Admin\RoleController@updateRole')->name('updateRole');
Route::post('roles/delete', 'Admin\RoleController@deleteRole');
// Routes for permissions
Route::resource('permissions', 'Admin\PermissionController');
Route::post('permissions/update/{id}', 'Admin\PermissionController@updatePermission')->name('updatePermission');
Route::post('permissions/delete', 'Admin\PermissionController@deletePermission');


Route::get('/home', 'HomeController@index')->name('home');
