<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Person;
use App\Models\Institution;
use App\Models\Official;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();        

            if (auth()->user()->activation == 1) {               

                $res = Person::where('user_id', auth()->user()->id)->count();

                if ($res > 0) {
                    return redirect()->route('data.person');
                }
                $res = Institution::where('user_id', auth()->user()->id)->count();
                if ($res > 0) {
                    return redirect()->route('data.institution');
                }

                $res = Official::where('user_id', auth()->user()->id)->count();
                if ($res > 0) {
                    return redirect()->route('page.dashboard');
                }
                //return redirect()->intended('dashboard');

            }
            return back()->withErrors([
                'email' => 'Cuenta no activada',
            ]);
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros. ',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }

    public function updatePassword()
    {
        return view('pages.updatePassword');
    }
}
