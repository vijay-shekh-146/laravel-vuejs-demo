<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamPlayer extends Pivot
{
    protected $table = 'team_players';

    protected $fillable = [
        'player_id',
        'team_id',
        'order_by',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
