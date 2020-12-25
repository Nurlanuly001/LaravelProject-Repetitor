<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
   return view('layouts.wrapper');
})->name('wrapper');


Route::resource('blogs','App\Http\Controllers\BlogController');

//Route::resource('/blogs', BlogController::class)->name('/blogs');

Route::get('/blogs/cat/{category}', [BlogController::class, 'blogsByCat'])->name('blogs.cat');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---------------------------------------
//Route::get('/teacher',[TeacherController::class, 'index'])->name('teacher');

Route::get('/courses', function (){
    return view('courses');
});
Route::get('/teachers', function (){
    return view('teachers');
});
Route::get('/pricing', function (){
    return view('pricing');
});
Route::get('/about', function (){
    return view('about');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('loginform');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerform');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/admin', [\App\Http\Controllers\loginController::class, 'adminIndex'])->name('admin.login');
Route::post('/admin', [\App\Http\Controllers\loginController::class, 'adminPosted'])->name('adminPosted');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin_panel/students', [\App\Http\Controllers\StudentController::class, 'index'])->name('admin.students');
    Route::get("/admin_panel",  [\App\Http\Controllers\admin_panel\dashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [\App\Http\Controllers\loginController::class, 'adminLogout'])->name('admin.logout');

    //categories
    Route::get('/admin_panel/categories',[\App\Http\Controllers\admin_panel\categorisController::class, 'index'] )->name('admin.categories');
    Route::post('/admin_panel/categories', [\App\Http\Controllers\admin_panel\categorisController::class, 'posted']);

    Route::get('/admin_panel/categories/edit/{id}', [\App\Http\Controllers\admin_panel\categorisController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/admin_panel/categories/edit/{id}', [\App\Http\Controllers\admin_panel\categorisController::class, 'update']);

    Route::get('/admin_panel/categories/delete/{id}',[\App\Http\Controllers\admin_panel\categorisController::class, 'delete'])->name('admin.categories.delete');
    Route::post('/admin_panel/categories/delete/{id}', [\App\Http\Controllers\admin_panel\categorisController::class, 'destroy']);


    //products
    Route::get('/admin_panel/courses', [\App\Http\Controllers\admin_panel\coursesController::class, 'index'])->name('admin.courses');

    Route::get('/admin_panel/courses/create',  [\App\Http\Controllers\admin_panel\coursesController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin_panel/courses/create',  [\App\Http\Controllers\admin_panel\coursesController::class, 'store']);

    Route::get('/admin_panel/courses/edit/{id}',  [\App\Http\Controllers\admin_panel\coursesController::class, 'edit'])->name('admin.courses.edit');
    Route::post('/admin_panel/courses/edit/{id}',  [\App\Http\Controllers\admin_panel\coursesController::class, 'update']);

    Route::get('/admin_panel/courses/delete/{id}',  [\App\Http\Controllers\admin_panel\coursesController::class, 'delete'])->name('admin.courses.delete');
    Route::post('/admin_panel/courses/delete/{id}',  [\App\Http\Controllers\admin_panel\coursesController::class, 'destroy']);

    //order management
    Route::get('/admin_panel/management',  [\App\Http\Controllers\admin_panel\managementController::class, 'manage'])->name('admin.orderManagement');
    Route::post('/admin_panel/management',  [\App\Http\Controllers\admin_panel\managementController::class, 'update'])->name('admin.orderUpdate');
});

