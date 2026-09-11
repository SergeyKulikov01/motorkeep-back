<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $sessions = Sessions::where('user_id', Auth::id())->orderBy('last_activity','desc')->get();
        $data = [
            'user' => Auth::user(),
            'sessions' => $sessions
        ];
        return view('pages.dashboard.settings.page',$data);
    }

    public function removeUser(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }
    public function changePwd(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required','confirmed',Password::defaults()],
            'password_confirmation' => ['required'],
        ]);
        $request->user()->update([
            'password' => Hash::make($data['password']),
        ]);
        return response()->json(['success' => true]);
    }
    public function deleteSessions(Request $request){

    }
}
