<?php

namespace Tests\Feature;

use App\Models\SampleTracking;
use App\Models\User;
use App\Models\Project;
use App\Models\Questionnaire;
use App\Models\Subject;
use App\Models\SampleTestTracking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SampleTrackingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature test to store a newly created sample tracking test in storage.
     *
     * @return void
     */
    public function test_sample_tracking_created_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        SampleTracking::factory()->create([
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57d004-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 17:36:32',
            'created_by' => 1,
            'updated_by' => 2,
        ]);

        $trackingData = [
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57d004-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 17:36:32',
            'created_by' => 1,
            'updated_by' => 2,
        ];

        $this->json('POST', 'api/tracking/sample', $trackingData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'latitude',
                    'longitude',
                    'unique_id',
                    'date_time',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display a listing of the sample tracking.
     *
     * @return void
     */
    public function test_sample_tracking_listed_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Project::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Project::factory()->create([
            'name' => 'Ebola',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'Joseph',
            'last_name' => 'Hobbs',
            'email' => 'hobbs@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-07-13',
            'phone' => '0772667345',
            'next_of_kin' => 'Esther Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Project::factory()->create([
            'name' => 'YELLOW FEVER',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'Sheilla',
            'last_name' => 'Mukisa',
            'email' => 'sheny@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1995-05-11',
            'phone' => '0783467345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0758765745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Questionnaire::factory()->create([
            'name' => 'Open questionnaire',
            'description' => 'Needs to be understood thoroughly'
        ]);

        Questionnaire::factory()->create([
            'name' => 'Static questionnaire',
            'description' => 'This needs to be unique'
        ]);

        Questionnaire::factory()->create([
            'name' => 'Closed questionnaire',
            'description' => 'This needs to be precise and concise'
        ]);

        SampleTracking::factory()->create([
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57d004-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 18:36:32',
            'created_by' => 1,
            'updated_by' => 2,
        ]);

        SampleTracking::factory()->create([
            'latitude' => '2.545988',
            'longitude' => '31.606786',
            'unique_id' => '7e57db54-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 18:40:32',
            'created_by' => 1,
            'updated_by' => 3,
        ]);

        SampleTracking::factory()->create([
            'latitude' => '2.587988',
            'longitude' => '34.603286',
            'unique_id' => '7e57d004-2b97-0f4a-D45f',
            'date_time' => '2020-09-01 18:43:32',
            'created_by' => 2,
            'updated_by' => 3,
        ]);

        SampleTestTracking::factory()->create([
            'sample_tracking_id' => 1,
            'questionnaire_id' => 1
        ]);

        SampleTestTracking::factory()->create([
            'sample_tracking_id' => 2,
            'questionnaire_id' => 2
        ]);

        SampleTestTracking::factory()->create([
            'sample_tracking_id' => 3,
            'questionnaire_id' => 3
        ]);

        $this->json('GET', 'api/tracking/sample', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    [
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                        'sample_tracking_id'
                    ],

                    [
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                        'sample_tracking_id'
                    ],

                    [
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                        'sample_tracking_id'
                    ],
                ],
                'message'
            ]);
    }
}
