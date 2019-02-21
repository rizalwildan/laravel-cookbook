<?php

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

Route::get('/', 'FrontController@index');
Route::get('detail-recipe/{slug}', 'FrontController@detailRecipe')->name('detail-recipe');
Route::get('category-by/{slug}', 'FrontController@recipeByCategory')->name('category-by');

Auth::routes();

// SuperAdmin Control Panel
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','role:administrator|superadministrator'], 'namespace' => 'Admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Users
    Route::resource('users', 'UsersController');
    Route::get('/get-users', 'UsersController@getUserData')->name('users-dt');

    // Roles
    Route::resource('roles', 'RolesController');
    Route::get('/get-roles', 'RolesController@getDataRoles')->name('roles-dt');

    // Permissions
    Route::resource('permissions', 'PermissionsController');
    Route::get('/get-permissions', 'PermissionsController@getDataPermissions')->name('permissions-dt');

    // Category
    Route::resource('category', 'CategoryController');
    Route::get('category-data', 'CategoryController@getDataCategory')->name('dt-category');

    // Ingredient
    Route::resource('ingredient', 'IngredientController');
    Route::get('ingredient-data', 'IngredientController@getIngredient')->name('dt-ingredient');

    // Recipe
    Route::resource('recipe', 'RecipeController');
    Route::get('recipe-data', 'RecipeController@getRecipe')->name('dt-recipe');

    Route::get('ingredients/find', 'RecipeController@find')->name('find-ingredient');
});

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
