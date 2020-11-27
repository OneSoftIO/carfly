$(function () {
    $('body').click(function(){
        $('[role=tooltip]').tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    })
    $('section.order .confirm-order').click(function(e){
        e.preventDefault();

        var po = '';
        var popanel = $(".payments-options .panel");
        $(popanel).each(function(index, value){
            if($(this).find('.panel-title a').attr('aria-expanded') == 'true'){
                //console.log($(this).find('.panel-title a').text());
                po = $(this).find('.panel-title a').attr('data-value');
               //po = po.trim();
            }
        });
        // var fdpass = $("#order input#fd-passport").val();
        // if (fdpass == "" ) {
        //     $("#order input#fd-passport").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
        //     $("#order input#fd-passport").focus();
        //     return false;
        // }
        //
        // var fdid = $("#order input#fd-id").val();
        // if (fdid == "" ) {
        //     $("#order input#fd-id").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
        //     $("#order input#fd-id").focus();
        //     return false;
        // }

        var accept = $("#accept");
        if(!accept.is(':checked')){
            $(accept).focus();
            $(accept).parent().tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            return false;
        }

        $("#preloader").show();
        var url = $("form#order").attr('action');
        var data = $("form#order").serialize();

        $.ajax({
            type:"POST",
            url:url,
            data:data + "&payment_method=" + po,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (response) {
                if(response.status)
                    window.location.replace(response.url);
            }
        });
        return false;
    })

});