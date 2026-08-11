<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function addReminder(Request $request)
    {
        $request->user()->cars()->findOrFail($request->input('car_id'));
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
        try {
            $remind = Reminders::create([
                'name' => $request->input('title'),
                'comment' => $request->input('text'),
                'user_id' => $request->user()->id,
                'type' => $request->input('reminder_type'),
                'date_of_exec' => $date,
                'cycle' => $request->input('reminder_cycle'),
                'car_id' => $request->input('car_id'),
            ]);
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function getReminder(Request $request)
    {
        try {
            $remind = Reminders::where([
                'user_id' => $request->user()->id,
                'car_id' => $request->input('car_id'),
            ])->select(['id', 'comment', 'name', 'type', 'date_of_exec', 'cycle'])
                ->orderByRaw('ABS(DATEDIFF(date_of_exec, ?))', [now()->toDateString()])
                ->get();
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'remind' => $remind, 'count' => $remind->count()]);
    }

    public function deleteReminder(Request $request)
    {
        try {
            $remind = Reminders::where([
                'id' => $request->input('id'),
                'user_id' => $request->user()->id,
            ])->delete();
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function updateReminder(Request $request)
    {
        try {
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
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
