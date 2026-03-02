<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SettlementController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/colocations/{colocation}', [ColocationController::class, 'show'])->name('colocations.show');

    Route::post('/colocations/{colocation}/invite', [ColocationController::class, 'sendInvitaion'])->middleware(['auth','colocation.role:owner'])->name('colocations.invite');
    Route::get('/invitations/{token}', [InvitationController::class, 'show'])->name('invitations.show');
    // Route::get('/invitations/{token}', [InvitationController::class, 'handle'])->name('invitations.handle');
    
    Route::post('/invitations/{token}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('/invitations/{token}/reject', [InvitationController::class, 'reject'])->name('invitations.reject');

    // Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/colocations/{colocation}', [CategoryController::class, 'store'])->name('categories.store');


    Route::get('/colocations/{colocation}/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/colocations/{colocation}/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/colocations/{colocation}/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

    Route::get('/colocations/{colocation}/settlements', [SettlementController::class, 'index'])->name('settlements.index');
    Route::post('/colocations/{colocation}/settlements/generate', [SettlementController::class, 'generate'])->name('settlements.generate');
    Route::patch('/settlements/{settlement}/paid', [SettlementController::class, 'markAsPaid'])->name('settlements.paid');

});

require __DIR__.'/auth.php';
