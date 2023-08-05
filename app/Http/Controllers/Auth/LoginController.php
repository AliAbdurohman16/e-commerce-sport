<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('customer_service')) {
            return RouteServiceProvider::DASHBOARD;
        }
        return RouteServiceProvider::HOME;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Set user status to online
        $this->setUserOnlineStatus($user->id, 1);
    }

    protected function logout(Request $request)
    {
        // Set user status to offline
        if (Auth::check()) {
            $this->setUserOnlineStatus(Auth::id(), 0);
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    protected function setUserOnlineStatus($userId, $status)
    {
        User::where('id', $userId)->update(['is_online' => $status]);
    }
}
