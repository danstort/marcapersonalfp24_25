<?php

use App\Http\Controllers\API\CicloController;
<<<<<<< HEAD
use App\Http\Controllers\API\FamiliaProfesionalController;
=======
use App\Http\Controllers\API\ReconocimientoController;
use App\Http\Controllers\API\ActividadController;
use App\Http\Controllers\API\FamiliaProfesionalController;
use App\Http\Controllers\API\ProyectoController;
use App\Http\Controllers\API\CurriculoController;
use App\Http\Controllers\API\UserController;
>>>>>>> 6b46599a89b62efe7ab07ca000b22924652271a3
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('ciclos', CicloController::class);
    Route::apiResource('actividades', ActividadController::class)->parameters(['actividades' => 'actividad']);
    Route::apiResource('familias_profesionales', FamiliaProfesionalController::class)->parameters([
        'familias_profesionales' => 'familiaProfesional'
    ]);
    Route::apiResource('curriculos', CurriculoController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('proyectos', ProyectoController::class);
    Route::apiResource('reconocimientos', ReconocimientoController::class);
});

Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);

    try {
        $records = json_decode($response->getBody()->getContents())->records;
        $response = response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);
    } catch (\Throwable $th) {

    }
    return $response;

})->where('any', '.*');
