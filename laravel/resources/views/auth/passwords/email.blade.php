@extends('auth.general')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group text-left{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">El.paštas</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary block full-width m-b">
                Atkurti slaptažodį
            </button>
        </div>
    </form>
@endsection
