<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected $user;


    protected function setUp(): void
    {
        parent::setUp();
        TaskStatus::factory()->count(2)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = TaskStatus::factory()->make()->only('name');
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', $taskStatus));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $taskStatus));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only('name');

        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $taskStatus1 = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', $taskStatus1));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', $taskStatus1->only('id'));

        $taskStatus2 = TaskStatus::factory()->hasTasks()->create();
        $response = $this->delete(route('task_statuses.destroy', $taskStatus2));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $taskStatus2->only('id'));
    }
}
