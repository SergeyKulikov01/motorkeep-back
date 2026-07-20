<?php

namespace App\Http\Controllers;

use App\Models\UserNotes;
use Illuminate\Http\Request;
use Throwable;

class UserNotesController extends Controller
{
    public function addNote(request $request){
        $request->user()->cars()->findOrFail($request->input('car_id'));
        try {
            $note = UserNotes::create([
                'name' => $request->input('noteTitle'),
                'comment' => $request->input('noteText'),
                'user_id' => $request->user()->id,
                'car_id' => $request->input('car_id'),
            ]);
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
    public function getNote(request $request){
        try {
            $note = UserNotes::where([
                'user_id' => $request->user()->id,
                'car_id' => $request->input('car_id'),
            ])->select(['id','comment','name'])->get();
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true, 'notes' => $note,'count' => $note->count()]);
    }
    public function deleteNote(request $request){
        try {
            $note = UserNotes::where([
                'user_id' => $request->user()->id,
                'id' => $request->input('note_id'),
            ])->select(['id','comment','name'])->delete();
        } catch (Throwable) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
    }
}
