<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CarDocs;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class CarDocsController extends Controller
{
    public function addDoc(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'car_id' => [
                    'required',
                    'integer',
                    Rule::exists('cars', 'id')->where('user_id', $request->user()->id),
                ],
                'type' => ['required', Rule::in(['insurance', 'registration', 'review', 'TransportPassport', 'other'])],
                'name' => ['required', 'string', 'max:255'],
                'date' => ['nullable', 'date'],
                'comment' => ['nullable', 'string'],
            ]);
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
            Log::error($e->getMessage(),['text' => 'Добавление дока', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
    }
    public function getDoc(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'car_id' => [
                    'required',
                    'integer',
                    Rule::exists('cars', 'id')->where('user_id', $request->user()->id),
                ]
            ]);
            $doc = CarDocs::where([
                'car_id' => $request->input('car_id'),
                'user_id' => $request->user()->id,
            ])->get();
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'docs' => $doc]);
    }
    public function deleteDoc(Request $request): JsonResponse
    {
        try {
            $doc = CarDocs::where([
                'id' => $request->input('doc_id'),
                'user_id' => $request->user()->id,
            ])->delete();
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'docs' => $doc]);
    }
}
