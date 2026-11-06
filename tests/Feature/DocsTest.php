<?php

namespace Tests\Feature;

use App\Models\CarDocs;
use App\Models\Cars;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Тесты документов машины (/api/car-docs).
 *
 * Контроллер ловит все исключения (включая ошибки валидации) и отвечает
 * 200 + {"success": false}, поэтому неуспешные сценарии проверяем
 * по полю success и по состоянию БД, а не по коду 422.
 */
class DocsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_doc(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/api/car-docs', [
            'car_id' => $car->id,
            'type' => 'insurance',
            'name' => 'ОСАГО',
            'date' => '2026-12-31',
            'comment' => 'Продлить до конца года',
        ]);

        $response->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseHas('car_docs', [
            'user_id' => $user->id,
            'car_id' => $car->id,
            'type' => 'insurance',
            'name' => 'ОСАГО',
        ]);
    }

    public function test_user_cannot_add_doc_to_foreign_car(): void
    {
        $owner = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($owner)->create();

        $response = $this->actingAs($hacker)->postJson('/api/car-docs', [
            'car_id' => $car->id,
            'type' => 'other',
            'name' => 'Чужой документ',
        ]);

        $response->assertJson(['success' => false]);
        $this->assertDatabaseCount('car_docs', 0);
    }

    public function test_add_doc_fails_with_invalid_type(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/api/car-docs', [
            'car_id' => $car->id,
            'type' => 'passport',
            'name' => 'Документ',
        ]);

        $response->assertJson(['success' => false]);
        $this->assertDatabaseCount('car_docs', 0);
    }

    public function test_add_doc_fails_without_name(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();

        $response = $this->actingAs($user)->postJson('/api/car-docs', [
            'car_id' => $car->id,
            'type' => 'other',
        ]);

        $response->assertJson(['success' => false]);
        $this->assertDatabaseCount('car_docs', 0);
    }

    public function test_user_sees_only_own_docs(): void
    {
        $me = User::factory()->create();
        $stranger = User::factory()->create();
        $car = Cars::factory()->for($me)->create();

        CarDocs::create(['user_id' => $me->id, 'car_id' => $car->id, 'type' => 'other', 'name' => 'Мой']);
        CarDocs::create(['user_id' => $stranger->id, 'car_id' => $car->id, 'type' => 'other', 'name' => 'Чужой']);

        $response = $this->actingAs($me)->getJson('/api/car-docs?car_id='.$car->id);

        $response->assertOk()
            ->assertJson(['success' => true])
            ->assertJsonCount(1, 'docs')
            ->assertJsonPath('docs.0.name', 'Мой');
    }

    public function test_user_cannot_get_docs_of_foreign_car(): void
    {
        $owner = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($owner)->create();
        CarDocs::create(['user_id' => $owner->id, 'car_id' => $car->id, 'type' => 'other', 'name' => 'Секрет']);

        $response = $this->actingAs($hacker)->getJson('/api/car-docs?car_id='.$car->id);

        $response->assertJson(['success' => false])
            ->assertJsonMissingPath('docs');
    }

    public function test_user_can_delete_own_doc(): void
    {
        $user = User::factory()->create();
        $car = Cars::factory()->for($user)->create();
        $doc = CarDocs::create(['user_id' => $user->id, 'car_id' => $car->id, 'type' => 'other', 'name' => 'Удалить']);

        $response = $this->actingAs($user)->deleteJson('/api/car-docs', ['doc_id' => $doc->id]);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseMissing('car_docs', ['id' => $doc->id]);
    }

    public function test_user_cannot_delete_someone_elses_doc(): void
    {
        $owner = User::factory()->create();
        $hacker = User::factory()->create();
        $car = Cars::factory()->for($owner)->create();
        $doc = CarDocs::create(['user_id' => $owner->id, 'car_id' => $car->id, 'type' => 'other', 'name' => 'Секрет']);

        $this->actingAs($hacker)->deleteJson('/api/car-docs', ['doc_id' => $doc->id]);

        $this->assertDatabaseHas('car_docs', ['id' => $doc->id]);
    }

    public function test_guest_cannot_access_docs(): void
    {
        $this->getJson('/api/car-docs')->assertUnauthorized();
        $this->postJson('/api/car-docs')->assertUnauthorized();
        $this->deleteJson('/api/car-docs')->assertUnauthorized();
    }
}
