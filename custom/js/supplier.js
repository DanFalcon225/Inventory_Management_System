var manageSupplierTable;

$(document).ready(function(){
    // top bar active
    $("#navSupplier").addClass('active');

    // manage brand table
    manageSupplierTable = $("#manageSupplierTable").DataTable({
        'ajax' : 'php_action/fetchSupplier.php',
        'order' : []
    });

   

});

function addSupplier(){

    $("#submitSupplierForm")[0].reset();
    // remove text
    $(".text-danger").remove();
    // remove form error
    $(".form-group").removeClass('has-error').removeClass('has-success');

     // submit brand form function
     $("#submitSupplierForm").unbind('submit').bind('submit', function(){

         // remove the error text
         $(".text-danger").remove();
         // remove the form error
         $(".form-group").removeClass('has-error').removeClass('has-success');
        
        var supplierName = $("#supplierName").val();
        var supplierStatus = $("#supplierStatus").val();

        if(supplierName ==""){
            $("#supplierName").after('<p class="text-danger">Supplier Name field is required</p>');
            $("#supplierName").closest('.form-group').addClass('has-error');
        } else {
            //remove error text field
            $("#supplierName").find('.text-danger').remove();
            $("#supplierName").closest('.form-group').addClass('has-success');

        }

        if(supplierStatus ==""){
            $("#supplierStatus").after('<p class="text-danger">Supplier Status field is required</p>');
            $("#supplierStatus").closest('.form-group').addClass('has-error');
        } else {
            //remove error text field
            $("#supplierStatus").find('.text-danger').remove();
            $("#supplierStatus").closest('.form-group').addClass('has-success');

        }

        if(supplierName && supplierStatus){
            var form = $(this);

            //button loading
            $("#createSupplierBtn").button('loading');

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success:function(response){
                    // button loading
                    $("#createSupplierBtn").button('reset');

                    if(response.success == true){
                        //reload the manage member table
                        manageSupplierTable.ajax.reload(null, false);

                        //reset the form text
                        $("#submitSupplierForm")[0].reset();
                        //remove the error text
                        $(".text-danger").remove();
                        //remove the form error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                        $("#add-supplier-messages").html('<div class="alert alert-success">'+
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
    }); // /sumbit brand form function
}




function editSuppliers(supplierId = null){
    if(supplierId){
        // remove supplierId
        $("#supplierId").remove();
        // refresh the form
        $("#editSupplierForm")[0].reset();
        // remove text
        $(".text-danger").remove();
        // remove form error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        
        $(".editSupplierFooter").after('<input type="hidden" name="supplierId" id="supplierId" value="'+supplierId+'" />')

        $.ajax({
            url: 'php_action/fetchSelectedSuppliers.php',
            type: 'post',
            data: {supplierId : supplierId},
            dataType: 'json',
            success:function(response){


                $("#editSupplierName").val(response.supplier_name);
                $("#editSupplierStatus").val(response.supplier_active);


                   // submit brand form function
                    $("#editSupplierForm").unbind('submit').bind('submit', function(){
                        
                        //remove the error text
                        $(".text-danger").remove();
                        //remove the form error
                        $(".form-group").removeClass("has-error").removeClass('has-success');

                        var supplierName = $("#editSupplierName").val();
                        var supplierStatus = $("#editSupplierStatus").val();

                        if(supplierName ==""){
                            $("#editSupplierName").after('<p class="text-danger">Supplier Name field is required</p>');
                            $("#editSupplierName").closest('.form-group').addClass('has-error');
                        } else {
                            //remove error text field
                            $("#editSupplierName").find('.text-danger').remove();
                            $("#editSupplierName").closest('.form-group').addClass('has-success');

                        }

                        if(supplierStatus ==""){
                            $("#editSupplierStatus").after('<p class="text-danger">Supplier Status field is required</p>');
                            $("#editSupplierStatus").closest('.form-group').addClass('has-error');
                        } else {
                            //remove error text field
                            $("#editSupplierStatus").find('.text-danger').remove();
                            $("#editSupplierStatus").closest('.form-group').addClass('has-success');

                        }

                        if(supplierName && supplierStatus){
                            var form = $(this);

                            //   //button loading
                            //   $("#editBrandBtn").button('loading');

                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: form.serialize(),
                                dataType: 'json',
                                success:function(response){
                                    // // button loading
                                    // $("#editBrandBtn").button('reset');

                                    if(response.success == true){
                                        //reload the manage member table
                                        manageSupplierTable.ajax.reload(null, false);


                                        //remove the error text
                                        $(".text-danger").remove();
                                        //remove the form error
                                        $(".form-group").removeClass('has-error').removeClass('has-success');

                                        $("#edit-supplier-messages").html('<div class="alert alert-success">'+
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
                    }); // /sumbit brand form function

            }// /success
        });// /ajax
    }
}




function removeSuppliers(supplierId = null) {
    if(supplierId){
        $("#removeSupplierBtn").unbind('click').bind('click', function(){
            $.ajax({
                url: 'php_action/removeSupplier.php',
                type: 'post',
                data: {supplierId : supplierId},
                dataType: 'json',
                success:function(response){
                    if(response.success == true) {

                        //hide the brand modal
                        $("#removeSupplierModal").modal('hide');

                        //reload the brand table
                        manageSupplierTable.ajax.reload(null, false);

                        $(".remove-messages").html('<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                        '</div>');

                        $(".alert-success").delay(500).show(10,function(){
                            $(this).delay(3000).hide(10, function(){
                                $(this).remove();
                            });
                        }); // /.alert
                    }
                }


            }); // /ajax
        });
        
    } // /if
}