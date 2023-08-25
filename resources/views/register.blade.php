<h1>Register</h1>

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

<form action="{{ route('user.store') }}" method="POST">
    @csrf


    <div>
        <div>
            <label for="login">Username *</label>
            <input type="text" id="login" name="login" value="{{ $user->login }}">
        </div>
        <div>
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" value="{{ $user->password }}">
        </div>
        <div>
            <label for="password-repeat">Repeat password* </label>
            <input type="password" id="password-repeat" name="password-repeat" value="{{ $user->repeatPassword }}">
        </div>
    </div>

    {{--optional fields--}}
    <div>
        <br>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" value="{{ $user->email }}">
        </div>
    </div>

    <p>* fields are required</p>

    <div>
        <input type="submit" value="Register">
    </div>
</form>
