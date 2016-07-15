<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('categories', 'CategoriesAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('categories', 'CategoryAPIController');
