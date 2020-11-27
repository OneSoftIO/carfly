@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Table with actions</h5>
			</div>
			<div class="ibox-content">
				<pre>
&lt;table datatable="" class="table table-striped table-bordered table-hover data-table">
&lt;thead>
	&lt;tr>
		&lt;th>El.paštas&lt;/th>
		&lt;th class="no-sort menu">Veiksmai&lt;/th>
	&lt;/tr>
&lt;/thead>
&lt;tbody>
	&lt;tr>
		&lt;td>edvinas.salt@gmail.com&lt;/td>
		&lt;td class="para">
			&lt;div class="dropdown">
			  &lt;a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				&lt;i class="fa fa-bars fa-lg">&lt;/i>

			  &lt;/a>
			  &lt;ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				&lt;li>&lt;a href="#">&lt;i class="fa fa-pencil fa-lg">&lt;/i> Redaguoti&lt;/a>&lt;/li>
				&lt;li>&lt;a href="#" data-href="delete.php?id=30" data-toggle="modal" data-target="#confirm-delete">&lt;i class="fa fa-trash-o fa-lg">&lt;/i> Itrinti&lt;/a>&lt;/li>
			  &lt;/ul>
			&lt;/div>
		&lt;/td>
	&lt;/tr>
	&lt;tr>
		&lt;td>asdasd&lt;/td>
		&lt;td class="para">
			&lt;div class="dropdown">
			  &lt;a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				&lt;i class="fa fa-bars fa-lg">&lt;/i>

			  &lt;/a>
			  &lt;ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				&lt;li>&lt;a href="#">&lt;i class="fa fa-pencil fa-lg">&lt;/i> Redaguoti&lt;/a>&lt;/li>
				&lt;li>&lt;a href="#" data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete">&lt;i class="fa fa-trash-o fa-lg">&lt;/i> Itrinti&lt;/a>&lt;/li>
			  &lt;/ul>
			&lt;/div>
		&lt;/td>
	&lt;/tr>
&lt;/tbody>
&lt;/table>

&#64include('components.modals.all')
				</pre>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Textarea editor</h5>
		</div>
		<div class="ibox-content">
			<pre>
&lt;div class="form-group">
	&lt;textarea name="editor1" id="editor" class="form-control">&lt;/textarea>
&lt;/div>
&lt;script>CKEDITOR.replace('editor');&lt;/script>
			</pre>
		</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Blank admin page</h5>
			</div>
			<div class="ibox-content">
			<pre>
&#64extends('admin.general')
&#64section('content')
&lt;div class="row">
	&lt;div class="col-lg-12">
		&lt;div class="ibox">
			&lt;div class="ibox-content">

			&lt;/div>
		&lt;/div>
	&lt;/div>
&lt;/div>
&#64endsection
			</pre>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Components</h5>
		</div>
		<div class="ibox-content">
			<pre>
&#64;include('components.modals.all')
CALL DELETE MODAL
&lt;a href="#" data-href="" data-toggle="modal" data-target="#confirm-delete">&lt;i class="fa fa-trash-o fa-lg">&lt;/i> Itrinti&lt;/a>
			</pre>
		</div>
		</div>
	</div>
</div>


@endsection