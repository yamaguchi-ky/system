<?php

use Illuminate\Database\Seeder;
use App\testUsers;

class testUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\testUsers::class,10)->create();
    }
}
