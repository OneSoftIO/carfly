@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<table datatable="" class="table table-striped table-bordered table-hover data-table">
				<thead>
					<tr>
						<th>Pavadinimas</th>
						<th>Nuoroda</th>
						<th>Būsena</th>
						<th class="no-sort menu">Veiksmai</th>
					</tr>
				</thead>
				<tbody>
				@foreach($terms as $term)
					@if(!empty($term->trans))
					<tr>
						<td>{{$term->trans->name}}</td>
						<td>{{$term->trans->slug}}</td>
						<td>
							@if($term->status == true)
								<span class="label label-primary text-uppercase">Įjungta</span>
							@else
								<span class="label label-danger text-uppercase">Išjungta</span>
							@endif
						</td>
						<td class="para">
							<div class="dropdown">
							  <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="fa fa-bars fa-lg"></i>
							  </a>
							  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
								<li><a href="#" target="_blank"><i class="fa fa-eye fa-lg"></i> Peržiūrėti</a></li>
								<li><a href="{{route('admin.category.edit', ['id' => $term->id, 'lang' => 'lt'])}}"><i class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>
								<li><a href="{{route('admin.delete', ['table' => 'terms', 'id' => $term->id])}}" data-href="delete.php?id=30" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Itrinti</a></li>
							  </ul>
							</div>
						</td>
					</tr>
					@endif
				@endforeach
				</tbody>
				</table>
			@include('components.modals.all')
			</div>
		</div>
	</div>
</div>
@endsection