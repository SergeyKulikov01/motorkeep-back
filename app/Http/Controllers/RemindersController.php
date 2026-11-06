<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Reminders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Validation\Rule;

class RemindersController extends Controller
{
    public function addReminder(Request $request)
    {
        try {
            $request->validate([
                'car_id' => ['required', 'exists:cars,id'],
                'date' => ['required', 'date'],
                'reminder_cycle' => ['required',
                    Rule::in(['week','month','year','month3','month6'])],
            ]);
            $date = $request->input('date');
            switch ($request->input('reminder_cycle')) {
                case 'week':
                    $date = Carbon::parse($request->input('date'))->addWeek()->format('Y-m-d');
                    break;
                case 'month':
                    $date = Carbon::parse($request->input('date'))->addMonth()->format('Y-m-d');
                    break;
                case 'month3':
                    $date = Carbon::parse($request->input('date'))->addMonths(3)->format('Y-m-d');
                    break;
                case 'month6':
                    $date = Carbon::parse($request->input('date'))->addMonths(6)->format('Y-m-d');
                    break;
                case 'year':
                    $date = Carbon::parse($request->input('date'))->addYear()->format('Y-m-d');
                    break;
        }
            $remind = Reminders::create([
                'name' => $request->input('title'),
                'comment' => $request->input('text'),
                'user_id' => $request->user()->id,
                'type' => $request->input('reminder_type'),
                'date_of_exec' => $date,
                'cycle' => $request->input('reminder_cycle'),
                'car_id' => $request->input('car_id'),
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage(),['text' => 'Добавление напоминания', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }

    public function getReminder(Request $request)
    {
        try {
            $request->validate([
                'car_id' => ['required', 'exists:cars,id'],
            ]);
            $remind = Reminders::where([
                'user_id' => $request->user()->id,
                'car_id' => $request->input('car_id'),
            ])->select(['id', 'comment', 'name', 'type', 'date_of_exec', 'cycle'])
                ->orderByRaw('ABS(DATEDIFF(date_of_exec, ?))', [now()->toDateString()])
                ->get();
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['text' => 'Получение напоминания', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true, 'remind' => $remind, 'count' => $remind->count()]);
    }

    public function deleteReminder(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'exists:reminders,id'],
            ]);
            $deleted = Reminders::where([
                'id' => $request->input('id'),
                'user_id' => $request->user()->id,
            ])->delete();
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['text' => 'Удаление напоминания', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => $deleted > 0]);
    }

    public function updateReminder(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required', 'exists:reminders,id'],
            ]);
            $remind = Reminders::where([
                'id' => $request->input('id'),
                'user_id' => $request->user()->id,
            ])->first();
            if ($remind->type == 'periodic') {
                switch ($remind->cycle) {
                    case 'week':
                        $date = Carbon::parse($request->input('date'))->addWeek()->format('Y-m-d');
                        break;
                    case 'month':
                        $date = Carbon::parse($request->input('date'))->addMonth()->format('Y-m-d');
                        break;
                    case 'month3':
                        $date = Carbon::parse($request->input('date'))->addMonths(3)->format('Y-m-d');
                        break;
                    case 'month6':
                        $date = Carbon::parse($request->input('date'))->addMonths(6)->format('Y-m-d');
                        break;
                    case 'year':
                        $date = Carbon::parse($request->input('date'))->addYear()->format('Y-m-d');
                        break;
                }
            } else {
                $date = Carbon::parse($remind->date_of_exec)->addWeek()->format('Y-m-d');
            }
            $remind->date_of_exec = $date;
            $remind->save();
        } catch (Throwable $e) {
            Log::warning($e->getMessage(), ['text' => 'Обновление напоминания', 'exception' => $e]);
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
}
