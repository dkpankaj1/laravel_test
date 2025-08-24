<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('todos.index');
});

Route::resource('todos', App\Http\Controllers\TodoController::class);
