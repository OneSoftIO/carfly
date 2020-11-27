@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12">
		@include('components.notifications.all')
		<form class="form-horizontal" role="form" method="POST" action="{{ route('users.store') }}">
        {{ csrf_field() }}
		<div class="ibox">
				<div class="ibox-title">
					<h5><i class="fa fa-user"></i> Pagrindinė informacija</h5>
				</div>
				<div class="ibox-content">
					<div class="form-group">
						<label id="f_name">Vardas, Pavardė:<i class="text text-danger">*</i></label>
						<input class="form-control" type="text" name="name" id="f_name" value="{{old('name')}}">
					</div> 
					<div class="form-group">
						<label id="email">El.paštas <i class="text text-danger">*</i></label>
						<input class="form-control" type="text" name="email" id="email" value="{{old('email')}}">
					</div>
					<div class="form-group">
						<label id="pass">Slaptažodis <i class="text text-danger">*</i></label>
						<input class="form-control" type="password" name="password" id="pass">
					</div>
					<div class="form-group">
						<label id="pass_repeat">Pakartoti slaptažodį <i class="text text-danger">*</i></label>
						<input class="form-control" type="password" name="password_confirmation" id="pass_repeat">
					</div>
					<div class="form-group">
						<label id="role" value="{{old('role')}}">Rolė <i class="text text-danger">*</i></label>
						<select name="role" id="role" class="form-control">
							@foreach($roles as $role)
								<option value="{{ $role }}">{{ $role }}</option>
							@endforeach
						</select>
					</div>
					<hr>
					<button type="submit" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Saugoti</button>
					<div class="clearfix"></div>
				</div>
		</div>
		</form>
	</div>
</div>
@endsection