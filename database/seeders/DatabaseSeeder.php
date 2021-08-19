<?php

namespace Database\Seeders;

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
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            SubjectsTableSeeder::class,
            ProjectsTableSeeder::class,
            StatusesTableSeeder::class,
            QuestionnairesTableSeeder::class,
            DatatypesTableSeeder::class,
            SubjectTrackingTableSeeder::class,
            SampleTrackingTableSeeder::class,
            SampleTestTrackingTableSeeder::class
        ]);
    }
}
