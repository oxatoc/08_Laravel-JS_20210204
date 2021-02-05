<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Click;

class ClickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Click::factory()
            ->times(100)
            ->create();
    }
}
