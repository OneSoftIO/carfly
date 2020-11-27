@extends('admin.general')
@section('content')
@include('components.modals.delete')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-content">
				<table datatable="" class="table table-striped table-bordered table-hover data-table">
				<thead>
					<tr>
						<th>Vardas</th>
						<th>El.paštas</th>
						<th>Tipas</th>
						<th>Vairuotojo numeris</th>
						<th>Telefono numeris</th>
						<th class="no-sort menu">Veiksmai</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td><span class="label label-danger text-uppercase">Administratorius</span></td>
						<td>{{$user->driver_license}}</td>
						<td>{{$user->phone_number}}</td>
						<td class="para">
							<div class="dropdown">
							  <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="fa fa-bars fa-lg"></i>
							  </a>
							  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
								{{--<li><a href="{{route('users.edit', $user->id)}}"><i class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>--}}
								<li><a href="#" data-href="{{route('users.destroy', $user->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Ištrinti</a></li>
							  </ul>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('components.modals.all')
@endsection