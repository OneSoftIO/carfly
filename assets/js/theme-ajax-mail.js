// Content Contact Form
// ---------------------------------------------------------------------------------------
$(function () {
    $("#contact-form .form-control").tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    $('#contact-form .form-control').blur(function () {
        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    });

    $("#contact-form #submit_btn").click(function () {

        $('#contact-form .error').hide();
        $("#contact-form .alert").remove();
        var $this = $(this);

        var name = $("#contact-form input#name").val();
        if (name == "" || name == "Name..." || name == "Name" || name == "Name *" || name == "Type Your Name...") {
            $("#contact-form input#name").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form input#name").focus();
            return false;
        }
        var email = $("#contact-form input#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        if (!filter.test(email)) {
            $("#contact-form input#email").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form input#email").focus();
            return false;
        }
        var subject = $("#contact-form input#subject").val();
        if (subject == "" || subject == "Subject") {
            $("#contact-form input#subject").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form input#subject").focus();
            return false;
        }
        var message = $("#contact-form #input-message").val();
        if (message == "" || message == "Message..." || message == "Message" || message == "Message *" || message == "Type Your Message...") {
            $("#contact-form #input-message").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $("#contact-form #input-message").focus();
            return false;
        }
        var recaptcha = grecaptcha.getResponse();
        if (recaptcha === "") {
            $("#contact-form .g-recaptcha").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            return false;
        }
        var dataString = 'name=' + name + '&email=' + email + '&message=' + message + '&captcha=' + recaptcha;
        var url = $("form#contact-form").attr('action');
        $this.hide();
        $.ajax({
            type:"POST",
            url:url,
            data:dataString,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (data) {
                if(data.status) {
                    $('#contact-form').append("<div class=\"alert alert-success fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>"+data.message+"</strong></div>");
                    $('#contact-form')[0].reset();
                }else{
                    $this.show();
                    $('#contact-form').append("<div class=\"alert alert-danger fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>"+data.message+"</strong></div>");
                }
            }
        });
        return false;
    });
});

// Subscribe Form
// ---------------------------------------------------------------------------------------
$(function () {
    $(".form-subscribe .form-control").tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    $('.form-subscribe .form-control').blur(function () {
        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    });

    $(".form-subscribe button").click(function () {
        // validate and process form
        // first hide any error messages
        $('.form-subscribe .error').hide();

        var email = $(".form-subscribe input#formSubscribeEmail").val();
        var privacy_policy = $(".form-subscribe .checkbox input").is(":checked");
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;

        if (!filter.test(email)) {
            $(".form-subscribe input#formSubscribeEmail").tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
            $(".form-subscribe input#formSubscribeEmail").focus();
            return false;
        }
        if(!privacy_policy){
            $(".form-subscribe .checkbox").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".form-subscribe .checkbox input").focus();
            return false;
        }
        var dataString = $(".form-subscribe").serialize();
        //alert (dataString);return false;
        var url = $('form.form-subscribe').attr('action');
        $.ajax({
            type:"POST",
            url: url,
            data:dataString,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (response) {
                $('.form-subscribe').append("<div class=\"alert error alert-"+response.status+" fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>"+response.message+"</strong></div>");
                $('.form-subscribe')[0].reset();
            }
        });
        return false;
    });
});

// Booking Form
// ---------------------------------------------------------------------------------------
$(function () {

    $(".form-additional .form-control, .form-delivery .form-control").tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    $('.form-additional .form-control, .form-delivery .form-control').blur(function () {
        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
    });

    //$(window).load(function () {});

    // ON CLICK
    $(".reservation-now .btn-reservation-now").click(function () {

        var counter = 1;
        var fdextras = '';
        var fdcheckbox = $(".form-extras .checkbox");
        $(fdcheckbox).each(function(index, value){
            if($(this).find('input').is(':checked')){
                fdextras = fdextras + ' extra' + counter + '=' + $(this).find('input').next('label').text();
                counter++;
            }
        });

        var fdmrms = '';
        var fdradio = $(".form-delivery .radio");
        $(fdradio).each(function(index, value){
            if($(this).find('input').is(':checked')){
                fdmrms = $(this).find('input').attr('value');
            }
        });

        var fdname = $(".form-delivery input#fd-name").val();
        if (fdname == "" ) {
            $(".form-delivery input#fd-name").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".form-delivery input#fd-name").focus();
            return false;
        }
        var fdemail = $(".form-delivery input#fd-email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        if (!filter.test(fdemail)) {
            $(".form-delivery input#fd-email").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".form-delivery input#fd-email").focus();
            return false;
        }

        var fdphone = $(".form-delivery input#fd-phone").val();
        if (fdphone == "" ) {
            $(".form-delivery input#fd-phone").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".form-delivery input#fd-phone").focus();
            return false;
        }
        var fdaddress = $(".form-delivery input#fd-address").val();
        if (fdaddress == "" ) {
            $(".form-delivery input#fd-address").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".form-delivery input#fd-address").focus();
            return false;
        }
        var privacy_policy = $(".privacy_policy input").is(":checked");
        if(!privacy_policy){
            $(".privacy_policy.checkbox").tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
            $(".privacy_policy.checkbox input").focus();
            return false;
        }


        var formUrl = $(".reservation-form").attr('action');
        var dataString = $(".reservation-form").serialize();
        $.ajax({
            type:"POST",
            url: formUrl,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:dataString,
            success:function (response) {
                $('.reservation-now').append("<div style=\"overflow: hidden; clear: both; \"></div><div style=\"overflow: hidden; clear: both; margin-top: 20px; \" class=\"alert alert-"+response.status+" fade in\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button><strong>"+response.message+"</strong></div>");
                //$('.reservation-now')[0].reset();
                if(response.status == 'success') {
                    $(".btn-reservation-now").hide();
                    setTimeout(function () {
                        window.location = response.redirect_url;
                    }, 3000);
                }
            }
        });
        return false;
    });
});