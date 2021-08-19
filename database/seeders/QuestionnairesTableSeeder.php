<?php

namespace Database\Seeders;

use App\Models\Questionnaire;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionnairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionnaires = [
            [
                'name' => 'Open-ended',
                'description' => 'Needs to ensure that respondents fully understand the questions and are not likely to refuse to answer.',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'name' => 'Static closed-ended',
                'description' => 'Needs to ensure that respondents fully understand the questions and are not likely to refuse to answer.',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'name' => 'Dynamic closed-ended',
                'description' => 'Needs to ensure that respondents fully understand the questions and are not likely to refuse to answer.',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ], 

            [
                'name' => 'Task-based',
                'description' => 'Needs to ensure that respondents fully understand the questions and are not likely to refuse to answer.',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Questionnaire::insert($questionnaires);
    }
}
