<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CarHistoryRequest;
use App\Services\CarHistory as CarHistoryService;
use Illuminate\Http\Request;
use Throwable;

class CarHistoryController extends Controller
{
    public function __construct(private readonly CarHistoryService $carHistoryService) {}

    public function addCarHistory(CarHistoryRequest $request)
    {
        try {
            $record = $this->carHistoryService->addRecord($request->user(), $request->validated());
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'record' => $record]);
    }
    public function getCarHistory(Request $request)
    {
        try {
            $record = $this->carHistoryService->getRecord($request->user(), (int) $request->input('car_id'));
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'records' => $record]);
    }
}
