<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            $player = [
                'name' => "Player $i",
                'email' => "player".$i."@gmail.com",
                'dob' => '1998-12-05',
            ];

            Player::firstOrCreate(
                ['name' => $player['name']],
                $player
            );
        }
    }
}
