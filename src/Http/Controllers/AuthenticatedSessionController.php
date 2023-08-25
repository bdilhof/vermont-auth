<?php

namespace VermontDevelopment\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use VermontDevelopment\Auth\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth::login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \VermontDevelopment\Auth\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $response = $request->authenticate();
        $requestExpectJson = in_array('application/json', $request->getAcceptableContentTypes());

        return $requestExpectJson ? response($response, 201) : redirect()->intended();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
