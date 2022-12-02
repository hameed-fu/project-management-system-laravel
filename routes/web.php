<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamMemberController;



Route::redirect('/', 'login', 301);

Route::get('login', [LoginController::class,'login'])->name('login');
Route::post('validate_login', [LoginController::class,'validateLogin'])->name('user.login');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [UserController::class,'dashboard'])->name('admin.dashboard');

    Route::get('users', [UserController::class,'users'])->name('users.index');
    Route::post('user/add', [UserController::class,'store'])->name('user.store');
    Route::post('user/update', [UserController::class,'update'])->name('user.update');
    Route::get('user/delete/{id}', [UserController::class,'delete'])->name('user.delete');
    Route::post('user/change_password', [UserController::class,'change_password'])->name('user.change_password');
    Route::get('user/change_status/{id}/{status}', [UserController::class,'change_status'])->name('user.change_status');
    

    Route::get('team-members', [TeamMemberController::class,'index'])->name('team_member');
    Route::post('team-member/add', [TeamMemberController::class,'store'])->name('team_member.add');
    Route::post('team-member/update', [TeamMemberController::class,'update'])->name('team_member.update');
    Route::get('team-member/delete/{id}', [TeamMemberController::class,'destroy'])->name('team_member.delete');

    Route::get('projects', [ProjectController::class,'index'])->name('projects');
    Route::post('projects/add', [ProjectController::class, 'store'])->name('project.store');
    Route::post('projects/update', [ProjectController::class, 'update'])->name('project.update');
    Route::get('projects/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');
    Route::get('projects/risks', [ProjectController::class, 'get_risks'])->name('project.risks');
    
    Route::get('projects/spent_hours', [ProjectController::class, 'spent_hours'])->name('project.spent_hours');
    Route::post('projects/add_spent_hours', [ProjectController::class, 'add_spent_hours'])->name('project.add_hours');
    Route::post('projects/update_spent_hours', [ProjectController::class, 'update_spent_hours'])->name('project.update_hours');
    Route::get('projects/delete_hours/{id}', [ProjectController::class, 'delete_hours'])->name('delete_hours');


    Route::get('logout', [UserController::class,'logout'])->name('admin.logout');

});