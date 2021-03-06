@extends('auth.general')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group text-left{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">El.paštas</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
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
    <div class="form-group text-left{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="control-label">Pakartoti slaptažodį</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary block full-width m-b">Atkurti Slaptažodį</button>
    </div>
</form>
@endsection
