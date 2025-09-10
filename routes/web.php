<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
// return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // for expense

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    // Route::get('/', [ExpenseController::class, 'index'])->name('dashboard');
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');



    // for income
    Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
    Route::get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
    Route::post('/incomes', [IncomeController::class, 'store'])->name('incomes.store');


    Route::get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
    Route::put('/incomes/{income}', [IncomeController::class, 'update'])->name('incomes.update');
    Route::delete('/incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');



    // for budget

    Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');
    Route::get('/budgets/{budget}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');
    Route::put('/budgets/{budget}', [BudgetController::class, 'update'])->name('budgets.update');
    Route::delete('/budgets/{budget}', [BudgetController::class, 'destroy'])->name('budgets.destroy');


    // for category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');



    // for ai suggestions
    Route::get('/expenses/ai-suggestion', [ExpenseController::class, 'getAISuggestion']);

    // Route::get('/expense-suggestion', [ExpenseController::class, 'showForm']);
    // Route::post('/expense-suggestion', [ExpenseController::class, 'getSuggestion']);

    Route::get('/expense-ai', [ExpenseController::class, 'index']); // agar index page hai
    Route::get('/expense-ai/suggestion', [ExpenseController::class, 'getAISuggestion'])->name('expense.ai.suggestion');
});

require __DIR__ . '/auth.php';
