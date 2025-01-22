<?php

use App\Http\Controllers\Api\MessagesroomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/allmesagges/{id_from}/{id_to}', [MessagesroomController::class, 'getallmessages_from_to']);
Route::post('/sendmessage', [MessagesroomController::class, 'sendmessage']);