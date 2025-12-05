<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamPlayerController;

Route::get('/get-teams',    [TeamPlayerController::class, 'get_teams'])->name('get_teams');
Route::get('/get-players',    [TeamPlayerController::class, 'get_players'])->name('get_players');
Route::get('/get-team-players',    [TeamPlayerController::class, 'get_team_players'])->name('get_team_players');
Route::post('/store-team-players',    [TeamPlayerController::class, 'store'])->name('store');

?>
