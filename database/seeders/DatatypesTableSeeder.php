<?php

namespace Database\Seeders;

use App\Models\DataType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatatypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataTypes = [
            [
                'id' => 1,
                'name' => 'radio button',
                'attributes' => '{
                    "gender" : "true"
                }',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 2,
                'name' => 'text field',
                'attributes' => '{
                    "text": "true"
                }',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 3,
                'name' => 'checkbox',
                'attributes' => '{
                    "select" : "false"
                }',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 4,
                'name' => 'date picker',
                'attributes' => '{
                    "date": "valid"
                }',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 5,
                'name' => 'time',
                'attributes' => '{
                    "time": "timestamp"
                }',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DataType::insert($dataTypes);
    }
}
