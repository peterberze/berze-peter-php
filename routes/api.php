<?php

use App\Http\Requests\VehicleIndexRequest;
use App\Http\Requests\VehicleStoreRequest;
use App\Models\Mongo\Vehicle;

use Illuminate\Support\Facades\Route;
use MongoDB\BSON\Regex;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/jarmuvek', function (VehicleStoreRequest $request) {
    try{
        $vehicle = new Vehicle();
        $vehicle->rendszam = $request->rendszam;
        $vehicle->tulajdonos = $request->tulajdonos;
        $vehicle->forgalmi_ervenyes = $request->forgalmi_ervenyes;
        $vehicle->adatok = $request->adatok;
        $vehicle->uuid = Uuid::uuid4()->toString();
        $vehicle->save();

        return response()->json([], 201, ['Location' => '/jarmuvek/'.$vehicle->uuid]);
    } catch (Exception) {
        return response()->json([], 400);
    }
});

Route::get('/jarmuvek', function () {
    return response()->json(Vehicle::query()->count());
});

Route::get('/jarmuvek/{uuid}', function(string $uuid) {
    return Vehicle::query()->where('uuid', '=', $uuid)->firstOrFail();
});

Route::get('/kereses', function (VehicleIndexRequest $request) {
    $regex = new Regex($request->get('q'), 'i');
    return Vehicle::query()
        ->where('rendszam', 'regex', $regex)
        ->orWhere('tulajdonos', 'regex', $regex)
        ->orWhere('adatok', 'regex', $regex)
        ->get();
});
