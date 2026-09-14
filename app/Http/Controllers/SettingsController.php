<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $sessions = Sessions::where('user_id', Auth::id())->orderBy('last_activity','desc')->get();
        $settings = UserSettings::where('user_id', Auth::id())->get()->first();
        $periodKm = [
            5000,
            7500,
            10000,
            15000,
        ];
        $changeTyreOptions = [
            'auto' => 'Автоматически (по дате)',
            'manual'=> 'Вручную (по пробегу)',
            'off' => 'Не напоминать',
        ];
        $data = [
            'user' => Auth::user(),
            'sessions' => $sessions,
            'settings' => $settings,
            'periodKm' => $periodKm,
            'changeTyreOptions' => $changeTyreOptions,
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
