<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Models\Team;
use App\Models\Player;
use App\Models\TeamPlayer;
use Illuminate\Support\Facades\Validator;

class TeamPlayerController extends Controller
{
    public function get_teams()
    {
        $teams = Team::orderBy('id', 'DESC')->get();
        return ApiResponse::success(200, 'Team list', $teams);
    }

    public function get_players()
    {
        $players = Player::orderBy('id', 'DESC')->get();
        return ApiResponse::success(200, 'Player list', $players);
    }

    public function get_team_players(){
        $teams = Team::select(['id', 'name','state','country'])
            ->with(['players' => function ($q) {
                $q->select(['players.id', 'players.name','players.email','players.dob']);
            }])
            ->get();

        $pending_players =Player::select(['id', 'name','email','dob'])->doesntHave('teams')->get();

        $data = [
            'teams' => $teams,
            'pending_players' => $pending_players,
        ];
        return ApiResponse::success(200, 'Team Player list', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'teams' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error(422, $validator->errors()->first());
        }

        $teams = $request->teams;
        TeamPlayer::truncate();

        foreach ($teams as $row_team) {
            $team_id = $row_team['id'];
            $player_ids = $row_team['players'] ?? [];

            foreach ($player_ids as $index => $player_id) {
                TeamPlayer::create([
                    'player_id' => $player_id,
                    'team_id' => $team_id,
                    'order_by' => $index
                ]);
            }
        }
        return ApiResponse::success(200, 'Saved successfully!', $teams);
    }
}
