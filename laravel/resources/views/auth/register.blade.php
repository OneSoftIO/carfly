@extends('auth.general')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-group text-left{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label">Vardas</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group text-left{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">El.paštas</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
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
    <div class="form-group text-left">
        <label for="password-confirm" class="control-label">Pakartoti slaptažodį</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary block full-width m-b">Registruotis</button>
    </div>
</form>
@endsection
