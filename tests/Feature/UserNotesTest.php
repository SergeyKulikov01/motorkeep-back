<?php

namespace Tests\Feature;

use App\Models\BodyTypes;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Cars;
use App\Models\User;
use App\Models\UserNotes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Тесты заметок к машине (/api/notes).
 *
 * RefreshDatabase перед первым тестом прогоняет все миграции в тестовой БД,
 * а каждый тест оборачивает в транзакцию и откатывает её в конце.
 * Поэтому каждый тест начинается с пустых таблиц и не влияет на соседей.
 */
class UserNotesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_note(): void
    {
        // Arrange — готовим данные
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();

        // Act — выполняем запрос от имени пользователя
        $response = $this->actingAs($user)->postJson('/api/notes', [
            'car_id' => $car->id,
            'noteTitle' => 'Масло',
            'noteText' => 'Проверить уровень масла',
        ]);

        // Assert — проверяем ответ и что запись реально появилась в БД
        $response->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseHas('user_notes', [
            'user_id' => $user->id,
            'car_id' => $car->id,
            'name' => 'Масло',
        ]);
    }

    public function test_user_sees_only_own_notes(): void
    {
        $me = User::factory()->create();
        $stranger = User::factory()->create();
        $car = Cars::factory()->for($me)->create();

        // Кладём записи в БД напрямую, минуя API
        UserNotes::create(['user_id' => $me->id, 'car_id' => $car->id, 'name' => 'Моя']);
        UserNotes::create(['user_id' => $stranger->id, 'car_id' => $car->id, 'name' => 'Чужая']);

        $response = $this->actingAs($me)->getJson('/api/notes?car_id='.$car->id);

        $response->assertOk()
            ->assertJsonPath('count', 1)
            ->assertJsonPath('notes.0.name', 'Моя');
    }

    public function test_user_cannot_delete_someone_elses_note(): void
    {
        $owner = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($owner)->create();
        $note = UserNotes::create(['user_id' => $owner->id, 'car_id' => $car->id, 'name' => 'Секрет']);

        $this->actingAs($hacker)->deleteJson('/api/notes', ['note_id' => $note->id]);

        // Заметка должна остаться на месте
        $this->assertDatabaseHas('user_notes', ['id' => $note->id]);
    }

    public function test_guest_cannot_access_notes(): void
    {
        $this->getJson('/api/notes')->assertUnauthorized();
    }
}
