<?php

use Illuminate\Database\Seeder;

class ProjectNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\project\Entities\ProjectNotes::class, 50)->create();
    }
}
