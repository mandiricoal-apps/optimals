<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return view('auth/login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/', function () {
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'home';
        return view('dashboard/dashboard', $data);
    });

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/modal-view-user/{id}', [UserController::class, 'modalViewuser']);
    Route::get('/modal-add-user', [UserController::class, 'modalAdduser']);
    Route::get('/modal-edit-user/{id}', [UserController::class, 'modalEdituser']);
    Route::post('/create-user', [UserController::class, 'createUser']);
    Route::post('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::get('/active-user/{id}', [UserController::class, 'activeUser']);
    Route::get('/inactive-user/{id}', [UserController::class, 'inactiveUser']);

    Route::get('/roles', [RolesController::class, 'index']);
    Route::post('/create-roles', [RolesController::class, 'createRole']);
    Route::post('/edit-role/{id}', [RolesController::class, 'editRole']);
    Route::get('/role-management/{id}', [RolesController::class, 'roleManagement']);
});
