<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
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

Route::get('/', function () {
    return view('welcome');
})->name('main');

require __DIR__ . '/auth.php';

Route::resources([
    'task_statuses' => TaskStatusController::class,
    'tasks' => TaskController::class,
    'labels' => LabelController::class,
]);
