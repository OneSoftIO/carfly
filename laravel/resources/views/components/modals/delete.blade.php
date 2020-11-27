<script>
$(window).ready(function(){
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
})
//<a href="#" data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Itrinti</a>
</script>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body inmodal text-center">
				<i class="fa fa-ban modal-icon text-danger"></i>
                <h2 class="text-center">Ar tikrai norite pašalinti?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Atšaukti</button>
                <a class="btn btn-danger btn-ok">Naikinti</a>
            </div>
        </div>
    </div>
</div>