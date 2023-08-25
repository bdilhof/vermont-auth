<div>

    <!-- Link with Logo -->
    <a href="/">
        <svg width="55" height="50" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
            <g>
                <title>Vermont Logo</title>
                <path stroke="#000" stroke-width="0.3"
                      d="m44.408,17.127l-8.638,4.512l-8.63699,-4.512l17.27499,0zm-8.55,14.95l0,-10.438l0,10.438zm-8.637,-14.95l-8.549,4.512l-8.638,-4.512l17.187,0zm-8.549,14.95l0,-10.438l0,10.438zm17.186,0l-8.637,4.511l-8.549,-4.511l17.186,0zm-8.637,14.95l0,-10.439l0,10.439zm0,-29.9l8.637,14.95l-8.637,-14.95zm-8.549,14.95l8.637,-4.512l8.638,4.512l-17.275,0zm17.186,0l-17.186,0l17.186,0zm-17.186,0l8.637,-14.95l-8.637,14.95zm8.549,-14.95l0,10.438l0,-10.438zm25.824,-14.95l-8.637,4.512l-8.638,-4.512l17.275,0zm-8.637,14.95l0,-10.439l0,10.439zm-25.736,-14.95l-8.638,4.512l-8.549,-4.512l17.187,0zm-8.637,14.95l0,-10.439l0,10.439zm25.823,-14.95l8.638,14.95l-8.638,-14.95zm-8.637,14.95l8.637,-4.512l8.638,4.512l-17.275,0zm17.187,0l-17.187,0l17.187,0zm-8.55,-14.95l0,10.438l0,-10.438zm-25.823,14.95l8.638,-4.512l8.637,4.512l-17.275,0zm17.186,0l-17.186,0l17.186,0zm-17.186,0l8.638,-14.95l-8.638,14.95zm8.637,-14.95l0,10.438l0,-10.438zm17.186,0l-8.637,14.95l-8.549,-14.95l-17.186,0l25.824,44.85l25.735,-44.85l-17.187,0z"
                      fill="none"/>
            </g>
        </svg>
    </a>

    <!-- Session Status -->
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div>
            <p>{{ __('Whoops! Something went wrong.') }}</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">

        <!-- CSRF Protection -->
        @csrf

        <!-- Login -->
        <div>
            <label for="username">{{ __('Login') }}</label>
            <input type="text" id="login" required autofocus value="{{ old('login') }}" name="login" placeholder="uXXXX" autocomplete="on">
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="" autocomplete="on">
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            <button type="submit">
                {{ __('Login') }}
            </button>
        </div>
    </form>

</div>
