<?php

use App\Http\Controllers\Api\AuthApi;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyInspectionController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/migrate', function () {
    return Artisan::call('migrate');
});
Route::get('/migrate-refresh', function () {
    return Artisan::call('migrate:refresh');
});
Route::get('/seed', function () {
    return Artisan::call('db:seed');
});
Route::get('/simbolik', function () {
    return Artisan::call('storage:link');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/', function () {
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'home';
        return view('dashboard/dashboard', $data);
    });

    Route::get('/company-api', [UserController::class, 'companyApi']);
    Route::get('/employee-api', [UserController::class, 'employeeApi']);


    Route::get('/modal-view-user/{id}', [UserController::class, 'modalViewuser']);
    Route::group(['middleware' => ['permission:view_user']], function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/modal-add-user', [UserController::class, 'modalAdduser']);
        Route::get('/modal-edit-user/{id}', [UserController::class, 'modalEdituser']);
        Route::post('/create-user', [UserController::class, 'createUser'])->middleware(['permission:create_user']);
        Route::post('/edit-user/{id}', [UserController::class, 'editUser'])->middleware(['permission:edit_user']);
        Route::get('/active-user/{id}', [UserController::class, 'activeUser'])->middleware(['permission:delete_user']);
        Route::get('/inactive-user/{id}', [UserController::class, 'inactiveUser'])->middleware(['permission:delete_user']);
    });

    Route::group(['middleware' => ['permission:view_roles']], function () {
        Route::get('/roles', [RolesController::class, 'index']);
        Route::post('/create-roles', [RolesController::class, 'createRole'])->middleware(['permission:create_roles']);
        Route::post('/edit-role/{id}', [RolesController::class, 'editRole'])->middleware(['permission:edit_roles']);
        Route::get('/role-management/{id}', [RolesController::class, 'roleManagement'])->middleware(['permission:edit_roles']);
        Route::post('/update-permission/{id}', [RolesController::class, 'updatePermission'])->middleware(['permission:edit_roles']);
        Route::get('/create-permission', [RolesController::class, 'halamanCreatePermission'])->middleware(['permission:edit_roles']);
        Route::post('/create-permission', [RolesController::class, 'createPermission'])->middleware(['permission:edit_roles']);
    });

    Route::group(['middleware' => ['permission:view_area']], function () {
        Route::get('/area', [AreaController::class, 'index']);
        Route::post('/create-area', [AreaController::class, 'createArea'])->middleware(['permission:create_area']);
        Route::post('/edit-area/{id}', [AreaController::class, 'editArea'])->middleware(['permission:edit_area']);
        Route::get('/active-area/{id}', [AreaController::class, 'activeArea'])->middleware(['permission:delete_area']);
        Route::get('/inactive-area/{id}', [AreaController::class, 'inactiveArea'])->middleware(['permission:delete_area']);
    });

    Route::group(['middleware' => ['permission:view_qna']], function () {
        Route::get('/qna', [QuestionController::class, 'index']);
        Route::get('/question/{area}', [QuestionController::class, 'question']);
        Route::get('/inactive-question/{id}', [QuestionController::class, 'inactiveQuestion'])->middleware(['permission:delete_qna']);
        Route::get('/active-question/{id}', [QuestionController::class, 'activeQuestion'])->middleware(['permission:delete_qna']);
        Route::post('/create-question', [QuestionController::class, 'createQuestion'])->middleware(['permission:create_qna']);
        Route::post('/edit-question/{id}', [QuestionController::class, 'editQuestion'])->middleware(['permission:edit_qna']);
        Route::get('/answer/{question}', [QuestionController::class, 'answer']);
        Route::post('/create-answer', [QuestionController::class, 'createAnswer'])->middleware(['permission:create_qna']);
        Route::post('/edit-answer/{id}', [QuestionController::class, 'editAnswer'])->middleware(['permission:edit_qna']);
    });
    Route::group(['middleware' => ['permission:view_daily_inspection']], function () {
        Route::get('/daily-inspection', [DailyInspectionController::class, 'index']);
        Route::get('/daily-inspection-area/{area}', [DailyInspectionController::class, 'perArea']);
        Route::get('/daily-inspection-detail/{dailyInspection}', [DailyInspectionController::class, 'detailDailyInspection']);
        Route::post('/edit-score/{dailyInspection}', [DailyInspectionController::class, 'editScore'])->middleware(['permission:edit_daily_inspection']);
        Route::get('/approve-daily-inspection/{dailyInspection}', [DailyInspectionController::class, 'approve'])->middleware(['permission:edit_daily_inspection']);
    });
    Route::group(['middleware' => ['permission:view_issue']], function () {
        Route::get('/issue', [IssueController::class, 'index']);
        Route::get('/detail-issue/{issue}', [IssueController::class, 'detail']);
        Route::post('//change-status-issue/{issue}', [IssueController::class, 'changeStatus'])->middleware(['permission:edit_issue']);
    });
});
