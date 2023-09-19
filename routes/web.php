<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ExerciseCategories;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealCategoriesController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\WorkOutsController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/firebase', function () {
    return view('firebase');
});
Route::get('/create-password/{id}', [App\Http\Controllers\UserController::class, 'createPassword']);
Route::post('users/passwordstore', [UserController::class, 'passwordstore'])->name('users.passwordstore');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
});

Route::get('/team', [App\Http\Controllers\TrainerController::class, 'index'])->name('team');

Route::get('users', [UserController::class, 'index']);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/list', [UserController::class, 'getUser'])->name('users.list');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::post('users/status', [UserController::class, 'status'])->name('users.status');


Route::get('roles', [RoleController::class, 'index']);
Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::patch('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::get('roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');

Route::get('tags', [TagsController::class, 'index']);
Route::get('tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('tags/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
Route::patch('tags/update/{id}', [TagsController::class, 'update'])->name('tags.update');
Route::get('tags/delete/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
Route::get('tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('tags/store', [TagsController::class, 'store'])->name('tags.store');
Route::get('tags/list', [TagsController::class, 'getTags'])->name('tags.list');

Route::get('exercise_categories', [ExerciseCategories::class, 'index']);
Route::get('exercise_categories', [ExerciseCategories::class, 'index'])->name('exercise_categories.index');
Route::get('exercise_categories/edit/{id}', [ExerciseCategories::class, 'edit'])->name('exercise_categories.edit');
Route::patch('exercise_categories/update/{id}', [ExerciseCategories::class, 'update'])->name('exercise_categories.update');
Route::get('exercise_categories/delete/{id}', [ExerciseCategories::class, 'destroy'])->name('exercise_categories.destroy');
Route::get('exercise_categories/create', [ExerciseCategories::class, 'create'])->name('exercise_categories.create');
Route::post('exercise_categories/store', [ExerciseCategories::class, 'store'])->name('exercise_categories.store');

Route::get('exercises', [ExerciseCategories::class, 'index']);
Route::get('exercises', [ExerciseCategories::class, 'index'])->name('exercise.index');
Route::get('exercises/edit/{id}', [ExerciseCategories::class, 'edit'])->name('exercise.edit');
Route::patch('exercises/update/{id}', [ExerciseCategories::class, 'update'])->name('exercise.update');
Route::get('exercises/delete/{id}', [ExerciseCategories::class, 'destroy'])->name('exercise.destroy');
Route::get('exercises/create', [ExerciseCategories::class, 'create'])->name('exercise.create');
Route::post('exercises/store', [ExerciseCategories::class, 'store'])->name('exercise.store');

Route::get('workouts', [WorkOutsController::class, 'index']);
Route::get('workouts', [WorkOutsController::class, 'index'])->name('workouts.index');
Route::get('workouts/edit/{id}', [WorkOutsController::class, 'edit'])->name('workouts.edit');
Route::patch('workouts/update/{id}', [WorkOutsController::class, 'update'])->name('workouts.update');
Route::get('workouts/delete/{id}', [WorkOutsController::class, 'destroy'])->name('workouts.destroy');
Route::get('workouts/create', [WorkOutsController::class, 'create'])->name('workouts.create');
Route::post('workouts/store', [WorkOutsController::class, 'store'])->name('workouts.store');
Route::get('workouts/list', [WorkOutsController::class, 'getWorkouts'])->name('workouts.list');


Route::get('meal-category', [MealCategoriesController::class, 'index']);
Route::get('meal-category', [MealCategoriesController::class, 'index'])->name('meal-category.index');
Route::get('meal-category/edit/{id}', [MealCategoriesController::class, 'edit'])->name('meal-category.edit');
Route::patch('meal-category/update/{id}', [MealCategoriesController::class, 'update'])->name('meal-category.update');
Route::get('meal-category/delete/{id}', [MealCategoriesController::class, 'destroy'])->name('meal-category.destroy');
Route::get('meal-category/create', [MealCategoriesController::class, 'create'])->name('meal-category.create');
Route::post('meal-category/store', [MealCategoriesController::class, 'store'])->name('meal-category.store');
Route::get('meal-category/list', [MealCategoriesController::class, 'getMealCategory'])->name('meal-category.list');

Route::get('meal', [MealController::class, 'index']);
Route::get('meal', [MealController::class, 'index'])->name('meal.index');
Route::get('meal/edit/{id}', [MealController::class, 'edit'])->name('meal.edit');
Route::patch('meal/update/{id}', [MealController::class, 'update'])->name('meal.update');
Route::get('meal/delete/{id}', [MealController::class, 'destroy'])->name('meal.destroy');
Route::get('meal/create', [MealController::class, 'create'])->name('meal.create');
Route::post('meal/store', [MealController::class, 'store'])->name('meal.store');
Route::get('meal/list', [MealController::class, 'getMeal'])->name('meal.list');

Route::get('food', [FoodController::class, 'index']);
Route::get('food', [FoodController::class, 'index'])->name('food.index');
Route::get('food/edit/{id}', [FoodController::class, 'edit'])->name('food.edit');
// Route::patch('food/update/{id}', [FoodController::class, 'update'])->name('food.update');
Route::get('food/delete/{id}', [FoodController::class, 'destroy'])->name('food.destroy');
Route::post('food/store', [FoodController::class, 'store'])->name('food.store');
Route::get('food/list', [FoodController::class, 'getFood'])->name('food.list');

// Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
// Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');
