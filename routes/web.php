<?php

use App\Http\Livewire\Expense\ExpenseCreateComponent;
use App\Http\Livewire\Expense\ExpenseEditComponent;
use App\Http\Livewire\Expense\ExpenseListComponent;
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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::prefix('expenses')->name('expenses.')->group(function(){

        Route::get('/', ExpenseListComponent::class)->name('index');

        Route::get('/create', ExpenseCreateComponent::class)
             //->middleware('check.amountexpenses')
            ->name('create');

        Route::get('/edit/{expense}', ExpenseEditComponent::class)->name('edit');
    });

});
