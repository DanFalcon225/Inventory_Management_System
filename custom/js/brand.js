var manageBrandTable;

$(document).ready(function(){
    // top bar active
    $("#navBrand").addClass('active');

    // manage brand table
    manageBrandTable = $("#manageBrandTable").DataTable({
        'ajax' : 'php_action/fetchBrand.php',
        'order' : []
    });

    // submit brand form function
    $("#submitBrandForm").unbind('submit').bind('submit', function(){
        
        //remove the error text
        $(".text-danger").remove();
        //remove the form error
        $(".form-group").removeClass("has-error").removeClass('has-success');

        var brandName = $("#brandName").val();
        var brandStatus = $("#brandStatus").val();

        if(brandName ==""){
            $("#brandName").after('<p class="text-danger">Brand Name field is required</p>');
            $("#brandName").closest('.form-group').addClass('has-error');
        } else {
            //remove error text field
            $("#brandName").find('.text-danger').remove();
            $("#brandName").closest('.form-group').addClass('has-success');

        }

        if(brandStatus ==""){
            $("#brandStatus").after('<p class="text-danger">Brand Status field is required</p>');
            $("#brandStatus").closest('.form-group').addClass('has-error');
        } else {
            //remove error text field
            $("#brandStatus").find('.text-danger').remove();
            $("#brandStatus").closest('.form-group').addClass('has-success');

        }

        if(brandName && brandStatus){
            var form = $(this);

            //button loading
            $("#createBrandBtn").button('loading');

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response){
                    // button loading
                    $("#createBrandBtn").button('reset');

                    if(response.success == true){
                        //reload the manage member table
                        manageBrandTable.ajax.reload(null, false);

                        //reset the form text
                        $("#submitBrandForm")[0].reset();
                        //remove the error text
                        $(".text-danger").remove();
                        //remove the form error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                        $("#add-brand-messages").html('<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                        '</div>');

                        $(".alert-success").delay(500).show(10,function(){
                            $(this).delay(3000).hide(10, function(){
                                $(this).remove();
                            });
                        }); // /.alert
                    } // /if
                }
            })
        }


        return false;
    });
});