<?php

namespace Tests\Feature;

use App\Models\Cars;
use App\Models\Reminders;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Тесты удаления напоминаний (DELETE /api/reminders).
 *
 * Фронтенд (detail.js) передаёт id в query-строке: /api/reminders?id=…
 */
class RemindersTest extends TestCase
{
    use RefreshDatabase;

    private function makeReminder(User $user, Cars $car): Reminders
    {
        return Reminders::create([
            'user_id' => $user->id,
            'car_id' => $car->id,
            'name' => 'Замена масла',
            'type' => 'reminder',
            'date_of_exec' => now()->addWeek()->toDateString(),
        ]);
    }

    public function test_user_can_delete_own_reminder(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $reminder = $this->makeReminder($user, $car);

        $response = $this->actingAs($user)->deleteJson('/api/reminders?id='.$reminder->id);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseMissing('reminders', ['id' => $reminder->id]);
    }

    public function test_user_cannot_delete_someone_elses_reminder(): void
    {
        $owner = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($owner)->create();
        $reminder = $this->makeReminder($owner, $car);

        $response = $this->actingAs($hacker)->deleteJson('/api/reminders?id='.$reminder->id);

        // Ответ — неуспех, а напоминание остаётся на месте
        $response->assertJson(['success' => false]);
        $this->assertDatabaseHas('reminders', ['id' => $reminder->id]);
    }

    public function test_delete_fails_for_missing_reminder(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->deleteJson('/api/reminders?id=999999')
            ->assertJson(['success' => false]);
    }

    public function test_delete_fails_without_id(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->deleteJson('/api/reminders')
            ->assertJson(['success' => false]);
    }

    public function test_guest_cannot_delete_reminder(): void
    {
        $this->deleteJson('/api/reminders?id=1')->assertUnauthorized();
    }
}
