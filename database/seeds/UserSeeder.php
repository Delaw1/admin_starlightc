<?php

use Illuminate\Database\Seeder;
use App\Workerstat;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create()->each(function($user) {
            Workerstat::create([
                'user_id' => $user->id,
                'department_id' => 1
            ]);
        });
        // factory(App\User::class, 10)->create();
    }
}
