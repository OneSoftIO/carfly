@extends('auth.general')
@section('content')

<form class="m-t" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form-group text-left{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">El.pašto adresas</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group text-left{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="control-label">Slaptažodis</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary block full-width m-b">Prisijungti</button>
        <a class="btn btn-sm btn-white btn-block" href="{{ route('password.request') }}">Pamiršai slaptažodį?</a>
    </div>
</form>
@endsection
