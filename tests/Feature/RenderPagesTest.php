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
        $this->actingAs($user)->get('/dashboard')->assertStatus(200);
    }
    public function test_render_dashboard_detail(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($user)->get('/dashboard/detail/'. $car->id)->assertStatus(200);
    }
    public function test_render_foreign_dashboard_detail(): void
    {
        $user = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($hacker)->get('/dashboard/detail/'. $car->id)->assertNotFound();
    }
    public function test_render_car_report(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($user)->get('/report/'. $car->report_id )->assertStatus(200);
    }
    public function test_render_stats(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/dashboard/stats')->assertStatus(200);
    }
    public function test_render_car_list(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $car = Cars::factory()->for($user)->create();
        $this->actingAs($user)->get('/dashboard/cars')->assertStatus(200);
    }
}
