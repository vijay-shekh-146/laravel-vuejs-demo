<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = "players";
    protected $fillable = ['name','email','dob'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_players')
                    ->using(\App\Models\TeamPlayer::class)
                    ->withPivot('order_by')
                    ->withTimestamps();
    }
}
