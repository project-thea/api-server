<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'COVID-19',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'EBOLA',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Yellow Fever',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Whooping Cough',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Cholera',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Brucellosis',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Anthrax',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Dengue',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Hepatitis',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Influenza',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '3',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Plague',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '3',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Rabies',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Tuberculosis',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Poliomyelitis',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Zika virus',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Tularaemia',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Measles',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '1',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Rubella',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '4',
                'updated_by' => '7',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Listeriosis',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '8',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'name' => 'Lassa fever',
                'description' => 'Most infected people will develop mild to moderate illness and recover without hospitalization.',
                'created_by' => '8',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
