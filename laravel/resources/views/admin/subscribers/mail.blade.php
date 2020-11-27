@extends('admin.general')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title">
				<h5><i class="fa fa-envelope-o"></i> Laiško turinys</h5>
			</div>
			<div class="ibox-content">
			<form>
				<div class="form-group">
					<div class="row">
						<label class="control-label col-lg-3">Tema <span class="text-danger">*</span></label>

						<div class="col-lg-9">
							<input class="form-control" name="subject" type="text">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
					<textarea name="editor1" id="editor" class="form-control"></textarea>
				</div>
				<script>
					CKEDITOR.replace( 'editor' );
				</script>
				<div class="text-right">
					<button type="submit" class="btn btn-warning">
						<b><i class="fa fa-envelope-o"></i></b> Siųsti laišką
					</button>
				</div>
				<div class="clearfix"></div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection