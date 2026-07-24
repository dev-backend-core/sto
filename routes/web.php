<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class,'index']);
Route::post('/post', [FrontendController::class,'form'])->name('form');

Route::get('/dashboard', function () {
    return view('admin.stuff.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Группа роутов, доступная ТОЛЬКО Владельцу (Owner)
// Route::middleware(['auth', 'role:owner'])->group(function () {
//     Route::get('/admin/finance', [FinanceController::class, 'index']); // Отчеты и деньги
//     Route::get('/admin/employees', [EmployeeController::class, 'index']); // Управление персоналом
// });

// Группа роутов, доступная Администратору (Admin) или Владельцу
// (Если нужно пустить обоих, можно сделать отдельную проверку или указать middleware)
// Route::middleware(['auth', 'role:admin,owner'])->group(function () {
//     Route::get('/stuff', [ProductController::class, 'stuff'])->name('staff'); 
//     Route::get('/stuff/profile', [ProductController::class, 'stuffProfile'])->name('staff.profile'); 
//     Route::get('/services', [ProductController::class, 'services'])->name('services'); 
//     Route::get('/services/details', [ProductController::class, 'servicesDetails'])->name('services.details'); 
//     Route::get('/services/create', [ProductController::class, 'store'])->name('services.store'); 
//     Route::get('/products', [ProductController::class, 'products'])->name('products'); 
//     Route::get('/clients', [ProductController::class, 'clients'])->name('clients');
//     Route::get('/statistic', [ProductController::class, 'statistic'])->name('statistic');
// });

require __DIR__.'/auth.php';
