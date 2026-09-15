<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
    public function setSettings(Request $request)
    {
        $allowedCodes = [
            'gender', 'about', 'date_birth', 'phone',
            'service_period', 'oil_period', 'change_tyre_notify',
            'summer_tyre', 'winter_tyre',
            'notify_next_service', 'notify_oil_change', 'notify_tyres_change', 'notify_change_breakes',
            'stats_week', 'stats_months',
            'notify_email', 'notify_push', 'notify_telegram',
        ];

        $data = $request->validate([
            'code' => ['required', 'string', Rule::in($allowedCodes)],
            'value' => ['required'],
        ]);

        UserSettings::where('user_id', Auth::id())->update([
            $data['code'] => $data['value'],
        ]);

        return response()->json(['success' => true]);
    }
}
