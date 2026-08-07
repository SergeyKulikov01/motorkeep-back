<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function addReminder(request $request){
        $request->user()->cars()->findOrFail($request->input('car_id'));
        try {
            $remind = Reminders::create([
                'name' => $request->input('title'),
                'comment' => $request->input('text'),
                'user_id' => $request->user()->id,
                'type' => $request->input('reminder_type'),
                'date_of_exec' => $request->input('date'),
                'cycle' => $request->input('reminder_cycle'),
                'car_id' => $request->input('car_id'),
            ]);
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
    public function getReminder(request $request){
        try {
            $remind = Reminders::where([
                'user_id' => $request->user()->id,
                'car_id' => $request->input('car_id'),
            ])->select(['id','comment','name','type','date_of_exec','cycle'])->get();
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true, 'remind' => $remind,'count' => $remind->count()]);
    }
}
