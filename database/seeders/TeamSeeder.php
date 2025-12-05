<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            ['name' => 'Rajkot',    'state' => 'Gujarat', 'country' => 'India'],
            ['name' => 'Surat',     'state' => 'Gujarat', 'country' => 'India'],
            ['name' => 'Baroda',    'state' => 'Gujarat', 'country' => 'India'],
            ['name' => 'Ahmedabad', 'state' => 'Gujarat', 'country' => 'India'],
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(
                ['name' => $team['name']],
                $team
            );
        }
    }
}
