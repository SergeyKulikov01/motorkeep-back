<?php

namespace Tests\Feature;
use App\Models\Cars;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RenderPagesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Рендер главной страницы.
     */
    public function test_render_main(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_render_dashboard(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($user)->get('/dashboard')->assertStatus(200);
    }
    public function test_render_dashboard_detail(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($user)->get('/dashboard/detail/'. $car->id)->assertStatus(200);
    }
}
