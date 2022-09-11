<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskTest extends TestCase
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
        Task::factory()->count(3)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = Task::factory()->make()->toArray();

        $response = $this->post(route('tasks.store'), $data);
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);
        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', ['name' => $data['name']]);
    }

    public function testEdit()
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.edit', $task));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();
        $data = Task::factory()->make()->toArray();

        $response = $this->patch(route('tasks.update', $task), $data);
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $data);
        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', ['name' => $data['name']]);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();
        $id = (array) $task->only('id');

        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));
        $response->assertStatus(403);

        $task->createdBy()->associate($this->user);
        $task->save();

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $id);
    }
}
