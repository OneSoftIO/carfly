@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				@include('components.notifications.all')
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
@foreach($posts  as $key => $post)
	<tr>
		<td>{{$post->translation->post_title}}</td>
		<td>{{$post->translation->slug}}</td>
		<td>
			@if($post->status == true)
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
			  @if($post->status == true)
				<li><a href="{{route('other.page', $post->translation->slug)}}" target="_blank"><i class="fa fa-eye fa-lg"></i> Peržiūrėti</a></li>
			  @endif
				<li><a href="{{route('admin.post.edit', ['id' => $post->id, 'lang' => 'lt'])}}"><i class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>
				<li><a href="#" data-href="{{route('admin.post.delete', $post->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Ištrinti</a></li>
			  </ul>
			</div>
		</td>
	</tr>
@endforeach
</tbody>
</table>

@include('components.modals.all')
			</div>
		</div>
	</div>
</div>
@endsection