<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    protected $redirectTo = '/login';

    use SendsPasswordResetEmails;
    
    // Additional methods and overrides can be added here

    protected function sendResetLinkResponse(Request $request, $response) {
        return redirect($this->redirectTo)->with('success', trans($response));
    }

    protected function validateEmail(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }
}