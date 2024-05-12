<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';


    public function reset(Request $request) {
        $request->validate(
                [
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]+$/'],
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'password.regex' => trans('translation.minimum_8_characters_with_a_symbol_a_cap_and_a_number'),
                'password.min' => trans('translation.minimum_8_characters_with_a_symbol_a_cap_and_a_number')
            ]
        );

        // Your existing password reset logic here...

        return redirect($this->redirectTo)->with('success', 'Password reset successfully');
    }
}
