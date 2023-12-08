<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('contents.authentications.forgot-password', ['pageConfigs' => $pageConfigs]);
        // return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:' . User::class],
        ]);

        // return Response::json(['success' => 'We have e-mailed your password reset link!'], 202);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == Password::RESET_LINK_SENT){
            return Response::json(['success' => 'We have e-mailed your password reset link!'], 202);
        }else{
            return Response::json(['success' => 'Error occured while sending e-mail please contact administrator!'], 202);
        }
    }
}
