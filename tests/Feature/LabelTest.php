<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Label;
use App\Models\User;
use App\Models\Task;

class LabelTest extends TestCase
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
        Label::factory()->count(2)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = Label::factory()->make()->toArray();

        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertRedirect(route('labels.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit()
    {
        $label = Label::factory()->create();
        $response = $this->get(route('labels.edit', $label));
        $response->assertStatus(403);

        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->toArray();

        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $label1 = Label::factory()->create();
        $id1 = $label1->id;

        $label2 = Label::factory()
            ->has(Task::factory()->count(1))
            ->create();
        $id2 = $label2->id;

        $this->actingAs($this->user);

        $response = $this->delete(route('labels.destroy', $label1));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $id1]);

        $response = $this->delete(route('labels.destroy', $label2));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['id' => $id2]);
    }
}
