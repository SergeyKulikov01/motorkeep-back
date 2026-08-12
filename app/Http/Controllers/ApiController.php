<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getBrandList(Request $request)
    {
        $name = $request->query('brand');

        $brands = Brand::when($name, fn ($query) => $query->where('name', 'like', "{$name}%"))
            ->orderBy('name')
            ->select('id', 'name')
            ->get();

        return response()->json($brands);
    }

    public function getModelsList(Request $request)
    {
        $brandId = $request->query('brand_id');
        $name = $request->query('name');

        $models = CarModel::where('brand_id', $brandId)
            ->when($name, fn ($query) => $query->where('name', 'like', "$name%"))
            ->orderBy('name')
            ->select('id', 'name')
            ->get();

        return response()->json($models);
    }
}
