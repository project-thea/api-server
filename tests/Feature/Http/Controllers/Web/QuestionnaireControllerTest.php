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
            'name' => '',
            'description' => 'Needs to ensure that respondents fully understand the questions',
        ];

        $response = $this->post('/questionnaires', $questionnairesData);

        $response->assertSessionHasErrors('name');
    }

    public function test_a_questionnaire_description_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $this->actingAs($user);

        $questionnairesData = [
            'name' => 'COVID-19',
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

        $expected = [
            'name' => 'open-ended',
            'description' => 'Needs to ensure that respondents fully understand the questions.'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertDatabaseHas('questionnaires', $expected);
    }

    public function test_a_questionnaire_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionnaireData = [
            'name' => 'Covid testing',
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
}
