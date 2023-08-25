<?php

namespace VermontDevelopment\Auth\Http\Requests;

use VermontDevelopment\Auth\Facades\HrmsFacade as Hrms;
use VermontDevelopment\Auth\Facades\LdapFacade as Ldap;
use VermontDevelopment\Auth\Helpers\Vermont;
use VermontDevelopment\Auth\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use VermontDevelopment\Auth\Services\AuthService;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => __('auth::auth.login'),
            'password.required' => __('auth::auth.password'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['login' => strtolower($this->login)]);
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return mixed
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        $helper = new Vermont();

        if ($helper->isNotLdapUCode($this->login)) {
            if (Auth::attempt(['login' => $this->login, 'password' => $this->password])) {

                $user = Auth::user();
                $token = $user->createToken('app-token')->plainTextToken;

                return [
                    'user' => $user,
                    'token' => $token,
                    'store' => session()->get('detected_store', [])
                ];
            } else {
                throw ValidationException::withMessages([
                    'login' => __('auth::auth.failed'),
                ]);
            }

        } else {

            if (Ldap::isNotAuthenticated($this->login, $this->password)) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'login' => __('auth::auth.failed'),
                ]);
            }

            $service = new AuthService();
            $response = $service->handleLocalUser($this->login);

            Auth::login($response['user'], $this->filled('remember'));
            RateLimiter::clear($this->throttleKey());

            return $response;
        }

    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }

}
