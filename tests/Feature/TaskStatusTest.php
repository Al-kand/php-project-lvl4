<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * user
     *
     * @var \App\Models\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        TaskStatus::factory()->make();
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
        $data = TaskStatus::factory()->make()->toArray();
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
        $data = TaskStatus::factory()->make()->toArray();

        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $taskStatus1 = TaskStatus::factory()->create();
        $name1 = (array) $taskStatus1->only(['name']);
        $response = $this->delete(route('task_statuses.destroy', $taskStatus1));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', $name1);

        $taskStatus2 = TaskStatus::factory()
            ->has(Task::factory()->count(1))
            ->create();
        $name2 = (array) $taskStatus2->only(['name']);
        $response = $this->delete(route('task_statuses.destroy', $taskStatus2));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $name2);
    }
}
