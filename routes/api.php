<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


Route::prefix("categories")->group(function () {
    Route::get("/", [CategoryController::class, "getAll"])->name("categories.getAll");
});

Route::prefix("user")->group(function () {
    Route::post("signup", [UserController::class, "signUp"])->name("user.signup");
    Route::post("login", [UserController::class, "signIn"])->name("user.login");
});
