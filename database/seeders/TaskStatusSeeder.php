<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use Carbon\Carbon;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskStatuses = collect([
            'новый',
            'в работе',
            'на тестировании',
            'завершен'
        ]);

        $taskStatuses->each(
            fn ($name) => TaskStatus::create(['name' => $name, 'created_at' => Carbon::now()->subYears(10)])
        );
    }
}
