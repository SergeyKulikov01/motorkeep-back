<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BodyTypes;
use App\Models\CarModel;
use App\Models\Cars;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class NewCarController extends Controller
{
    public function index()
    {
        $types = BodyTypes::all();
        $colors = Color::all();
        $data = [
            'body' => $types,
            'colors' => $colors,
        ];

        return view('pages.dashboard.add.page', $data);
    }

    public function addCar(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|integer',
            'car_model_id' => 'required|integer',
            'year' => 'required|integer',
            'body_type_id' => 'required|integer',
            'color' => 'required|integer',
            'engine_volume' => 'required|float',
            'transmission_type' => 'required|string',
            'vin' => 'required|string',
            'plate_number' => 'required|string',
            'plate_region' => 'required|integer',
            'mileage' => 'required|integer',
            'comment' => 'required|string',
        ]);

        try {
            $model = CarModel::findOrFail($request->modelId);
            $reportId = $request->user()->id . '-' . $model->name . '-' . Str::random(8);
            Cars::create([
                'user_id' => $request->user()->id,
                'report_id' => $reportId,
                'brand_id' => $request->brandId,
                'car_model_id' => $request->modelId,
                'year' => $request->year,
                'body_type_id' => $request->bodyType,
                'color' => $request->color,
                'engine_volume' => $request->engine,
                'transmission_type' => $request->transmission,
                'vin' => $request->vin,
                'plate_number' => is_string($request->plate)? strtoupper($request->plate) : '',
                'plate_region' => $request->region,
                'mileage' => $request->mileage,
                'comment' => $request->comment,
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'Добавление авто', 'exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
