<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TaskStatusSeeder::class,
        ]);

        $dateLabel = Carbon::now()->subYears(10);
        $dateTask = Carbon::now()->subYears(10);

        \App\Models\User::factory(10)->create();

        \App\Models\Label::factory(10)
            ->state(new Sequence(
                fn () => [
                    'created_at' => $dateLabel
                        ->addMonths(rand(1, 12))
                        ->addDays(rand(1, 30))
                ],
            ))
            ->create();

        \App\Models\Task::factory(20)
            ->state(new Sequence(
                fn () => [
                    'status_id' => \App\Models\TaskStatus::all()->random()->id,
                    'created_by_id' =>  \App\Models\User::all()->random()->id,
                    'assigned_to_id' =>  \App\Models\User::all()->random()->id,
                    'created_at' => $dateTask
                        ->addMonths(rand(1, 6))
                        ->addDays(rand(1, 30))
                ],
            ))
            ->hasAttached(
                \App\Models\Label::all()->random(rand(0, 4))
            )
            ->create();
    }
}
