<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LoginController;
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects', [SubjectController::class, 'index']);
});

Route::get('/', function () {
    return view('index');
});

use Illuminate\Support\Facades\Response;

Route::get('/build/{file}', function ($file) {
    $path = public_path("build/$file");

    if (file_exists("$path.gz")) {
        return Response::make(file_get_contents("$path.gz"))
            ->header('Content-Encoding', 'gzip')
            ->header('Content-Type', mime_content_type($path));
    }

    abort(404);
})->where('file', '.*');
Route::get('/getlinksurl', [LinkController::class, 'getLinksUrl']);
Route::post('/teacher/upload', [LinkController::class, 'stores']);
Route::post('/teacher/getUploads', [LinkController::class, 'getUploads']);