<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BodyTypes;
use App\Models\CarModel;
use App\Models\Cars;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
