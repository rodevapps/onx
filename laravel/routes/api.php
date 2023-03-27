<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Client;
use App\Models\Worker;
use App\Models\Car;

use App\Notifications\CarAttachedToClient;
use App\Notifications\CarDetachedFromClient;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clients', function() {
    return Client::all();
});

Route::post('clients', function(Request $request) {
    $client = new Client;
    $client->name = $request->name;
    $client->surname = $request->surname;
    $client->worker_id = $request->worker_id;

    return $client->save();
});

Route::get('clients/{id}', function(int $id) {
    return Client::with(['worker', 'orders', 'cars'])->where('id', $id)->get();
});

Route::match(['put', 'patch'], '/clients/{id}', function (int $id, Request $request) {
    $client = Client::findOrFail($id);
    $client->name = $request->name;
    $client->surname = $request->surname;
    $client->worker_id = $request->worker_id;

    return $client->save();
});

Route::options('clients/{id}', function(int $id) {
});

Route::delete('clients/{id}', function(int $id) {
    $client = Client::findOrFail($id);

    return $client->delete();
});

Route::get('clients/{id}/car/attach/{cid}', function(int $id, int $cid) {
    Client::findOrFail($id)->cars()->attach($cid);

    $client = Client::findOrFail($id);
    $worker = Client::findOrFail($id)->worker;

    $client->notify(new CarAttachedToClient($id, $cid));
    $worker->notify(new CarAttachedToClient($id, $cid));

    return '{"status":"success","message":"Car ' . $cid . ' attached to client."}';
});

Route::get('clients/{id}/car/detach/{cid}', function(int $id, int $cid) {
    Client::findOrFail($id)->cars()->detach($cid);

    $client = Client::findOrFail($id);
    $worker = Client::findOrFail($id)->worker;

    $client->notify(new CarDetachedFromClient($id, $cid));
    $worker->notify(new CarDetachedFromClient($id, $cid));

    return '{"status":"success","message":"Car ' . $cid . ' detached from client."}';
});

Route::get('clients/{id}/car/{cid}', function(int $id, int $cid) {
    return Client::with(['cars' => function ($query) use ($cid) {
        $query->where('cars.id', $cid);
    }])->where('clients.id', $id)->get();
});
