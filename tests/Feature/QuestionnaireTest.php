<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Questionnaire;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionnaireTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature test to store a newly created questionnaire in storage.
     *
     * @return void
     */
    public function test_questionnaire_created_successfully()
    {
        $this->withoutExceptionHandling();

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

        Questionnaire::factory()->create([
            'name' => 'open-ended',
            'description' => 'Very vital questionnaire'
        ]);

        $questionnaireData = [
            'name' => 'open-ended',
            'description' => 'Very vital questionnaire'
        ];

        $this->json('POST', 'api/questionnaires', $questionnaireData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display a listing of the questionnaire.
     *
     * @return void
     */
    public function test_questionnaire_listed_successfully()
    {
        $this->withoutExceptionHandling();

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
            'name' => 'Questionnaire One',
            'description' => 'Explains questionnaire one'
        ]);

        Questionnaire::factory()->create([
            'name' => 'Questionnaire Two',
            'description' => 'Explains questionnaire two'
        ]);

        Questionnaire::factory()->create([
            'name' => 'Questionnaire Three',
            'description' => 'Explains questionnaire three'
        ]);

        $this->json('GET', 'api/questionnaires', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                    ],

                    [
                        'id',
                        'name',
                        'description',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                    ],

                    [
                        'id',
                        'name',
                        'description',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display a specific questionnaire.
     *
     * @return void
     */
    public function test_show_questionnaire_successfully()
    {
        $this->withoutExceptionHandling();

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

        $questionnaire = Questionnaire::factory()->create([
            'name' => 'Static-ended',
            'description' => 'Needs to ensure that respondents fully understand',
        ]);

        $this->json('GET', 'api/questionnaires/' . $questionnaire->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
                'message'
            ]);
    }


    /**
     * A feature test to update a specific test in storage.
     *
     * @return void
     */
    public function test_questionnaire_updated_successfully()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        $subject = Subject::factory()->create([
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

        $questionnaire = Questionnaire::factory()->create([
            'name' => 'Static-ended',
            'description' => 'Needs to ensure that respondents fully understand',
        ]);

        $payload = [
            'name' => 'Static-ended',
            'description' => 'Needs to ensure that respondents fully understand',
        ];

        $this->json('PATCH', 'api/questionnaires/' . $questionnaire->id, $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ],
                'message'
            ]);
    }

    /**
     * A feature test to remove a specific questionnaire from storage.
     *
     * @return void
     */
    public function test_delete_questionnaire()
    {
        $this->withoutExceptionHandling();

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

        $questionnaire = Questionnaire::factory()->create([
            'name' => 'Static-ended',
            'description' => 'Needs to ensure that respondents fully understand',
        ]);

        $this->json('DELETE', 'api/questionnaires/' . $questionnaire->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}
