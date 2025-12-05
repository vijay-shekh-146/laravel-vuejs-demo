<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name','state','country'];
    protected $table = "teams";

    public function players()
    {
        return $this->belongsToMany(Player::class, 'team_players')
                    ->using(\App\Models\TeamPlayer::class)
                    ->withPivot(['team_id', 'player_id', 'order_by'])
                    ->orderBy('team_players.order_by');
    }
}
