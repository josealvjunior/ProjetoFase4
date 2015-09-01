<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\project\Entities\Client::truncate();
        factory(\project\Entities\Client::class, 10)->create();
    }
}
