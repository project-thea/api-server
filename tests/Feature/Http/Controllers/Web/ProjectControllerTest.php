<?php

namespace Tests\Feature\Http\Controllers\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Project;
use App\Models\User;
use Inertia\Testing\Assert;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_projects_index_page_is_rendered()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/projects')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Projects/Index')
                    ->has('projects')
                    ->has('trashedProjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });
    }

    public function test_a_project_name_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $this->actingAs($user);

        $projectsData = [
            'name' => '',
            'description' => 'Very deadly disease',
        ];

        $response = $this->post('/projects', $projectsData);

        $response->assertSessionHasErrors('name');
    }

    public function test_a_project_description_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $this->actingAs($user);

        $projectsData = [
            'name' => 'COVID-19',
            'description' => '',
        ];

        $response = $this->post('/projects', $projectsData);

        $response->assertSessionHasErrors('description');
    }

    public function test_a_project_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $expected = [
            'name' => 'Ebola',
            'description' => 'This is a deadly disease'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/projects', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Projects/Index')
                    ->has('projects')
                    ->has('trashedProjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertDatabaseHas('projects', $expected);
    }

    public function test_a_project_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $project = Project::factory()->create();

        $projectData = [
            'name' => 'Covid',
            'description' => 'This is a very deadly disease',
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/projects/' . $project->id, $projectData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Projects/Index')
                    ->has('projects')
                    ->has('trashedProjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $projectData['id'] = $project->id;    
        $this->assertDatabaseHas('projects', $projectData);
    }

    public function test_a_project_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $project = Project::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->delete('/projects/' . $project->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Projects/Index')
                    ->has('projects')
                    ->has('trashedProjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }

    public function test_a_project_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $project = Project::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/projects/' . $project->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Projects/Index')
                    ->has('projects')
                    ->has('trashedProjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }
}
