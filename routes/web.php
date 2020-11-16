<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresarioController;

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

// Route::get('/', function () {
//     return view('welcome');
//     // return file_get_contents('http://fx.currencysystem.com/webservices/CurrencyServer4.asmx?WSDL');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('empresarios');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/', function(){
    return redirect()->route('dashboard');
})->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [EmpresarioController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/{id}', [EmpresarioController::class, 'show']);

Route::middleware(['auth:sanctum', 'verified'])->post('/create', [EmpresarioController::class, 'create'])->name('create');

Route::middleware(['auth:sanctum', 'verified'])->post('/edit/{id}', [EmpresarioController::class, 'edit'])->name('edit');

Route::middleware(['auth:sanctum', 'verified'])->get('/delete/{id}', [EmpresarioController::class, 'delete'])->name('delete');

Route::middleware(['auth:sanctum', 'verified'])->get('/tooglestate/{id}', [EmpresarioController::class, 'tooglestate'])->name('tooglestate');
