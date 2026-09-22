<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ApiController extends Controller
{
    public function getBrandList(Request $request)
    {
        try {
            $name = $request->query('brand');

            $brands = Brand::when($name, fn ($query) => $query->where('name', 'like', "{$name}%"))
                ->orderBy('name')
                ->select('id', 'name')
                ->get();
        } catch (Throwable $e){
            Log::error($e->getMessage(),['text' => 'Api controller', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json($brands);
    }

    public function getModelsList(Request $request)
    {
        try {
            $brandId = $request->query('brand_id');
            $name = $request->query('name');

            $models = CarModel::where('brand_id', $brandId)
                ->when($name, fn ($query) => $query->where('name', 'like', "$name%"))
                ->orderBy('name')
                ->select('id', 'name')
                ->get();
        } catch (Throwable $e){
            Log::error($e->getMessage(),['text' => 'Api controller', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json($models);
    }
}
