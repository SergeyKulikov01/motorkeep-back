<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CarDocs;
use Throwable;

class CarDocsController extends Controller
{
    public function addDoc(Request $request): JsonResponse
    {
        try {
            $doc = CarDocs::create([
                'car_id' => $request->input('car_id'),
                'user_id' => $request->user()->id,
                'type' => $request->input('type'),
                'comment' => $request->input('comment'),
                'date' => $request->input('date'),
                'name' => $request->input('name'),
            ]);
            return response()->json(['success' => true]);
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }
    }
    public function getDoc(Request $request): JsonResponse
    {
        try {
            $doc = CarDocs::where([
                'car_id' => $request->input('car_id'),
                'user_id' => $request->user()->id,
            ])->get();
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'docs' => $doc]);
    }
}
