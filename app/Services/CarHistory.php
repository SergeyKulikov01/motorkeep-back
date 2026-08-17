<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CarHistory as CarHistoryModel;
use App\Models\User;
use Illuminate\Support\Collection;

class CarHistory
{
    public function addRecord(User $user, array $data): CarHistoryModel
    {
        $user->cars()->findOrFail($data['car_id']);

        return CarHistoryModel::create([
            'user_id' => $user->id,
            'car_id' => $data['car_id'],
            'name' => $data['name'],
            'place' => $data['place'] ?? null,
            'volume' => $data['volume'] ?? null,
            'mileage' => $data['mileage'] ?? 0,
            'price' => $data['price'] ?? 0,
            'date' => $data['date'],
            'type' => $data['type'],
            'comment' => $data['comment'] ?? null,
            'file_id' => null,
        ]);
    }
    public function getRecord(User $user, int $car_id, ?string $type = null): Collection
    {
        $user->cars()->findOrFail($car_id);

        return CarHistoryModel::where('user_id', $user->id)
            ->where('car_id', $car_id)
            ->when($type, fn ($query) => $query->where('type', $type))
            ->get();
    }
    public function deleteRecord(User $user, int $car_id, int $id): int
    {
        $user->cars()->findOrFail($car_id);

        return CarHistoryModel::where('user_id', $user->id)
            ->where('car_id', $car_id)
            ->where('id', $id)
            ->delete();
    }
}
