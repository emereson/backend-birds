<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BirdsController;
use App\Http\Controllers\PlateColorsController;
use App\Http\Controllers\BirdImagesController;
use App\Http\Controllers\BirdVideosController;
use App\Http\Controllers\BirdColorController;
use App\Http\Controllers\CrestTypeController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\BirdFightsController;
use App\Http\Controllers\BirthsController;






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/signup', [UserController::class, 'signup']);
Route::post('/user/login', [UserController::class, 'login']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//plate color
Route::get('/plate-color', [PlateColorsController::class, 'index']);
Route::post('/plate-color', [PlateColorsController::class, 'store']);
Route::patch('/plate-color/{id}', [PlateColorsController::class, 'update']);
Route::delete('/plate-color/{id}', [PlateColorsController::class, 'destroy']);


// Rutas para las aves
Route::get('/birds/in-care', [BirdsController::class, 'indexBirdInCare']);
Route::get('/birds/mother', [BirdsController::class, 'indexMother']);
Route::get('/birds/father', [BirdsController::class, 'indexFather']);
Route::get('/birds', [BirdsController::class, 'index']);
Route::get('/birds/family-tree/{id}', [BirdsController::class, 'index_family_tree']);
Route::get('/birds/{id}', [BirdsController::class, 'index_one']);
Route::post('/birds', [BirdsController::class, 'store']);
Route::patch('/birds/in-care/{id}', [BirdsController::class, 'updateInCare']);
Route::patch('/birds/{id}', [BirdsController::class, 'update']);

Route::delete('/birds/{id}', [BirdsController::class, 'destroy']);



// Rutas para las imagenes del ave
Route::get('/bird-images', [BirdImagesController::class, 'index']);
Route::post('/bird-images', [BirdImagesController::class, 'store']);
Route::delete('/bird-images/{id}', [BirdImagesController::class, 'destroy']);

// Rutas para los videos del ave
Route::get('/bird-videos', [BirdVideosController::class, 'index']);
Route::post('/bird-videos', [BirdVideosController::class, 'store']);
Route::delete('/bird-videos/{id}', [BirdVideosController::class, 'destroy']);


//vaccine
Route::get('/vaccine/{id}', [VaccineController::class, 'index']);
Route::post('/vaccine', [VaccineController::class, 'store']);
Route::patch('/vaccine/{vaccine}', [VaccineController::class, 'update']);
Route::delete('/vaccine/{vaccine}', [VaccineController::class, 'destroy']);


// bird-color
Route::get('/bird-color', [BirdColorController::class, 'index']);
Route::post('/bird-color', [BirdColorController::class, 'store']);
Route::patch('/bird-color/{id}', [BirdColorController::class, 'update']);
Route::delete('/bird-color/{id}', [BirdColorController::class, 'destroy']);

// bird-fitgh
Route::get('/bird-fight', [BirdFightsController::class, 'index']);
Route::get('/bird-fight/{id}', [BirdFightsController::class, 'getBirdFights']);
Route::post('/bird-fight', [BirdFightsController::class, 'store']);
Route::patch('/bird-fight/{bird_Fights}', [BirdFightsController::class, 'update']);
Route::delete('/bird-fight/{bird_Fights}', [BirdFightsController::class, 'destroy']);

//nacimiento de los pollitos
Route::get('/births', [BirthsController::class, 'index']);
Route::post('/births', [BirthsController::class, 'store']);
Route::patch('/births/{births}', [BirthsController::class, 'update']);
Route::delete('/births/{births}', [BirthsController::class, 'destroy']);


// crest type
Route::get('/crest-type', [CrestTypeController::class, 'index']);
Route::post('/crest-type', [CrestTypeController::class, 'store']);
Route::patch('/crest-type/{id}', [CrestTypeController::class, 'update']);
Route::delete('/crest-type/{id}', [CrestTypeController::class, 'destroy']);

// line
Route::get('/line', [LineController::class, 'index']);
Route::post('/line', [LineController::class, 'store']);
Route::patch('/line/{id}', [LineController::class, 'update']);
Route::delete('/line/{id}', [LineController::class, 'destroy']);

// origin
Route::get('/origin', [OriginController::class, 'index']);
Route::post('/origin', [OriginController::class, 'store']);
Route::patch('/origin/{id}', [OriginController::class, 'update']);
Route::delete('/origin/{id}', [OriginController::class, 'destroy']);


// status
Route::get('/status', [StatusController::class, 'index']);
Route::post('/status', [StatusController::class, 'store']);
Route::patch('/status/{id}', [StatusController::class, 'update']);
Route::delete('/status/{id}', [StatusController::class, 'destroy']);

//weeight
Route::get('/weight', [WeightController::class, 'index']);
Route::post('/weight', [WeightController::class, 'store']);
Route::patch('/weight/{id}', [WeightController::class, 'update']);


