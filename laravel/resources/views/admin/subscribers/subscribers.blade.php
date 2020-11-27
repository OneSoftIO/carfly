@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox-content">
			 
			<table datatable="" class="table table-striped table-bordered table-hover data-table">
			<thead>
				<tr>
					<th>El.paštas</th>
					<th>IP Adresas</th>
					<th>Užsiregistravo</th>
					<th class="no-sort menu">Veiksmai</th>
				</tr>
			</thead>
			<tbody>
				@foreach($subscribers as $item)
				<tr>
					<td>{{$item->email}}</td>
					<td>{{$item->ip}}</td>
					<td>{{$item->created_at}}</td>
					<td class="para">
						<div class="dropdown">
						  <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-bars fa-lg"></i>
							
						  </a>
						  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
							{{--<li><a href="#"><i class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>--}}
							<li><a href="#" data-href="{{route('admin.subscriber.remove', $item->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Itrinti</a></li>
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
@include('components.modals.all')
@endsection