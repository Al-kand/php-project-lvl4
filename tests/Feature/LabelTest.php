<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Label;
use App\Models\User;

class LabelTest extends TestCase
{
    use RefreshDatabase;

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
        $data = Label::factory()->make()->only('name');
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
        $data = Label::factory()->make()->only('name');

        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $Label1 = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $Label1));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', $Label1->only('id'));

        $Label2 = Label::factory()->hasTasks()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $Label2));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $Label2->only('id'));
    }
}
