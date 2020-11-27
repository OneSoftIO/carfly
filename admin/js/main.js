$(document).ready(function () {
    CloneAutoCategoryFields();
    AddPrice();
    addPriceRow();
    RemoveBlock();
    DeleteDelivery();
    UploadImage();
    changeLang();
});
function DeleteDelivery(){
    $('.delete-group').on('click', function () {
        $(this).parent().remove();
    })
}
function RemoveBlock(){
    $(".delete-group").on('click', function(){
        $(this).parent().remove();
    })

}
function changeLang(){
    var defaultValue = $(".js-on-change-lang").val();
    $(".js-on-change-lang").change(function(){
        var value = $(this).val();

        var confirmAlert = confirm("Dėmesio! Nepamirškite išsaugoti informaciją šioje kalboje. Kitaip jūsų atnaujinimai dings. Grįžkite spausdami - cancel.");
        if(confirmAlert == true){
            var href = $(this).find(':selected').data('href');
            window.location.href = href;
        } else {
            $(this).val(defaultValue);
        }

    });
}
function CloneAutoCategoryFields(){
    $(".add-field").on('click', function(e){
        e.preventDefault();

        var html = $(".clone-form").html();
        $(".form-holder").append(html);
    })
}
function AddPrice(){
    $(".add-price").on('click', function () {
        var html = $(".price-holder-clone").html();
        $(".price-loop-holder").append(html);
    })
}
function RemovePrice(id){
    $.get(
        '/administruoti/delete/prices/'+id,
        {
            "_token": $( this ).find( 'input[name=_token]' ).val(),
            "id": id,
        },
        'json'
    ).done(function() {
        $('.price-holder[data-id='+id+']').remove();
    });
}
function RemoveRow(row, value){
    $('.'+value+'-holder li[data-row='+row+']').remove();
    var formData = $('form').serialize();
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
        },
        url: '/administruoti/settings/delete/row/'+value,
        data: formData,
        processData: false,
        success: function(msg) {
        }
    });
};
function RemoveImage(id, sk){
    $.get(
        '/administruoti/vehicles/'+sk+'/images/delete/'+id,
        {
            "_token": $( this ).find( 'input[name=_token]' ).val(),
            "sk": id,
        },
        'json'
    ).done(function() {
        $('.image-holder[data-sk='+id+']').remove();
    });
}
function AddRow(name){
        var html = $("."+name+"-clone-holder").html();
        $("."+name+"-clone").append(html);
        RemoveBlock();
}
function UploadImage(){
    $(".file_image").on('change', function(e){
        var name = $(this).val();
        $splitName =  name.split("\\").pop();
        var test = $(this).parent().find(".image_name").val($splitName);
    })
}

function addPriceRow(){
    $(".add_price_row").click(function(e){
        e.preventDefault();
        var output = $(this).parent().parent().parent().find(".prices-list-container > div").first().clone();
        $(this).parent().parent().parent().find(".prices-list-container").append(output);
        $(this).parent().parent().parent().find(".prices-list-container > div:last-child input").val(" ");
    });
}

