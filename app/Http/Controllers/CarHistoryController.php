<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CarHistoryRequest;
use App\Services\CarHistory as CarHistoryService;
use App\Models\CarHistory;
use App\Models\Cars;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CarHistoryController extends Controller
{
    public function __construct(private readonly CarHistoryService $carHistoryService) {}

    public function addCarHistory(CarHistoryRequest $request)
    {
        try {
            $record = $this->carHistoryService->addRecord($request->user(), $request->validated());
        }
        catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'Добавление истории', 'exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'record' => $record]);
    }
    public function getCarHistory(Request $request)
    {
        try {
            $record = $this->carHistoryService->getRecord($request->user(), (int) $request->input('car_id'),$request->input('type'));
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'records' => $record]);
    }
    public function deleteCarHistory(Request $request)
    {
        try {
            $record = $this->carHistoryService->deleteRecord($request->user(), (int) $request->input('car_id'), (int) $request->input('id'));
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
    public function show(Cars $car,CarHistory $entry){
        Gate::authorize('view',$car);
        return $entry;
    }
}
