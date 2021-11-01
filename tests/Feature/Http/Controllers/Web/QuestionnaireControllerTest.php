<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class QuestionnaireControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_questionnaires_index_page_is_rendered()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/questionnaires')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index');
            });
    }

    public function test_a_questionnaire_name_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $this->actingAs($user);

        $questionnairesData = [
            'label' => '',
            'description' => 'Needs to ensure that respondents fully understand the questions',
        ];

        $response = $this->post('/questionnaires', $questionnairesData);

        $response->assertSessionHasErrors('label');
    }

    public function test_a_questionnaire_description_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $this->actingAs($user);

        $questionnairesData = [
            'label' => 'COVID-19',
            'description' => '',
        ];

        $response = $this->post('/questionnaires', $questionnairesData);

        $response->assertSessionHasErrors('description');
    }

    public function test_a_questionnaire_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaireData = [
            'label' => 'close-fixed',
            'description' => 'Needs to ensure that respondents at least fully understand the questions.'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires', $questionnaireData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertDatabaseHas('questionnaires', $questionnaireData);
    }

    public function test_a_questionnaire_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionnaireData = [
            'label' => 'Covid testing',
            'description' => 'Needs to understands the questions',
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/questionnaires/' . $questionnaire->id, $questionnaireData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $questionnaireData['id'] = $questionnaire->id;
        $this->assertDatabaseHas('questionnaires', $questionnaireData);
    }

    public function test_a_questionnaire_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->delete('/questionnaires/' . $questionnaire->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }

    public function test_a_questionnaire_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/questionnaires/' . $questionnaire->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }

    public function test_can_preview_a_questionnaire_and_its_attributes()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $this->actingAs($user)
            ->get('/questionnaires/' . $questionnaire->id . '/preview')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Preview');
            });
    }
}
