<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Tester One',
            'email' => 'tester@testing.com'
        ]);

        Listing::factory(7)->create([
            'user_id' => $user->id
        ]);
    }
}
