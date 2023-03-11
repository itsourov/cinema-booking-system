<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('ticket')->middleware(['auth'])->group(function () {
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
    Route::put('/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
});
