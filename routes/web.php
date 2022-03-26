<?php

use App\Http\Livewire\Expense\ExpenseCreateComponent;
use App\Http\Livewire\Expense\ExpenseEditComponent;
use App\Http\Livewire\Expense\ExpenseListComponent;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\{File, Storage};

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

        Route::get('/{expense}/photo', function(Expense $expense){
            $expense = auth()->user()->expenses->find($expense);
            $image = null;
            if(!Storage::disk("public")->exists($expense->photo)){
                return abort(404, "Image not found!!");
            }
            $image = Storage::disk("public")->get($expense->photo);
            $mimeType = File::mimeType(storage_path('app/public/' . $expense->photo));

            return response($image)->header('Content-Type', $mimeType);
        })->name('expenses-image');
    });

});
