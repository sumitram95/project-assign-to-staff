<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postions = ['Frontend', 'Backend', 'FullStack', 'CEO', 'Project Manager', 'Team Leader'];

        foreach ($postions as $postion) {
            Position::create([
                'position' => $postion
            ]);
        }

    }
}
