var manageCategoriesTable;

$(document).ready(function(){
    //active top navbar categories
    $("#navCategories").addClass('active');

    manageCategoriesTable = $('#manageCategoriesTable').DataTable({
        'ajax' : 'php_action/fetchCategories.php',
        'order' : []
    }); //manage categories datatable

}); // /document


    // on click on sumbit categories form modal
function addCategories(){

        // reset the form text
        $("#submitCategoriesForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        $("#submitCategoriesForm").unbind('submit').bind('submit', function(){

            // remove the error text
            $(".text-danger").remove();
            // remove the form error
            $(".form-group").removeClass('has-error').removeClass('has-success');


            var categoriesName = $('#categoriesName').val();
            var categoriesStatus = $("#categoriesStatus").val();

            if(categoriesName == ""){
                $("#categoriesName").after('<p class="text-danger">Category Name Field is required</p>');
                $("#categoriesName").closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#categoriesName").find('.text-danger').remove();
                // success out for form
                $("#categoriesName").closest('.form-group').addClass('has-success');
            }

            if(categoriesStatus == ""){
                $("#categoriesStatus").after('<p class="text-danger">Category Status Field is required</p>');
                $("#categoriesStatus").closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#categoriesStatus").find('.text-danger').remove();
                // success out for form
                $("#categoriesStatus").closest('.form-group').addClass('has-success');
            }


            if(categoriesName && categoriesStatus){
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success:function(response){
                        if(response.success == true){
                            // reload the manage categories data table
                            manageCategoriesTable.ajax.reload(null, false);

                            // reset the form text
                            $("#submitCategoriesForm")[0].reset();
                            // remove the error text
                            $(".text-danger").remove();
                            // remove the error form
                            $(".form-group").removeClass('has-error').removeClass('has-success');

                            $("#add-categories-messages").html('<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                            '</div>');

                            //remove the messages after 10 sec
                            $('.alert-success').delay(500).show(10, function(){
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            });

                        } // /if
                    } // /success
                }); // /ajax
            } // /if


            return false;
        }); // /submit categories form function

}
        



// remove categories function 
function removeCategories(categoriesId = null){
    if(categoriesId){
        // remove categories button click to remove
        $("#removeCategoriesBtn").unbind('click').bind('click', function(){
            $.ajax({
                url: 'php_action/removeCategories.php',
                type: 'post',
                data: {categoriesId : categoriesId},
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {
                        // close the modal
                        $("#removeCategoriesModal").modal('hide');
                        // update the manage categories
                        manageCategoriesTable.ajax.reload(null, false);
                        // show the message
                        $(".remove-messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '<strong><i class="glyphicon - glyphicon-ok-sign"></i> </strong>' + response.messages +
                        '</div>');

                    } else {

                        // close the modal
                        $("#removeCategoriesModal").modal('hide');
                        // show the message
                        $(".remove-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '<strong><i class="glyphicon - glyphicon-exclamation-sign"></i> </strong>' + response.messages +
                        '</div>');
  
                    }
                }


            });
        });
    } // /if categories id
} // /remove categories function 

//edit categories function
function editCategories(categoriesId = null) {
    if(categoriesId){

        // remove the categories id
        $("#editCategoriesId").remove();
        // reset the form text
        $("#editCategoriesForm")[0].reset();
        // reset the form thex-error
        $('.text-danger').remove();
        // reset the form group error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        // edit categories messages remove
        $("#edit-categories-messages").html("");

        $.ajax({
            url: 'php_action/fetchSelectedCategories.php',
            type: 'post',
            data: {categoriesId : categoriesId},
            dataType: 'json',
            success:function(response){
                $("#editCategoriesName").val(response.categories_name);
                $("#editCategoriesStatus").val(response.categories_active);

                //add categories id
                $(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.categories_id+'"/>')

                // submit of edit categories form
                $("#editCategoriesForm").unbind('submit').bind('submit', function(){

                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $(".form-group").removeClass('has-error').removeClass('has-success');
        
        
                    var categoriesName = $('#editCategoriesName').val();
                    var categoriesStatus = $("#editCategoriesStatus").val();
        
                    if(categoriesName == ""){
                        $("#editCategoriesName").after('<p class="text-danger">Category Name Field is required</p>');
                        $("#editCategoriesName").closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editCategoriesName").find('.text-danger').remove();
                        // success out for form
                        $("#editCategoriesName").closest('.form-group').addClass('has-success');
                    }
        
                    if(categoriesStatus == ""){
                        $("#editCategoriesStatus").after('<p class="text-danger">Category Status Field is required</p>');
                        $("#editCategoriesStatus").closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editCategoriesStatus").find('.text-danger').remove();
                        // success out for form
                        $("#editCategoriesStatus").closest('.form-group').addClass('has-success');
                    }
        
        
                    if(categoriesName && categoriesStatus){
                        var form = $(this);
        
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response){
                                if(response.success == true){
                                    // reload the manage categories data table
                                    manageCategoriesTable.ajax.reload(null, false);
        
                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the error form
                                    $(".form-group").removeClass('has-error').removeClass('has-success');
        
                                    $("#edit-categories-messages").html('<div class="alert alert-success">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
                                    '</div>');
        
                                    //remove the messages after 10 sec
                                    $('.alert-success').delay(500).show(10, function(){
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                        });
                                    });
        
                                } // /if
                            } // /success
                        }); // /ajax
                    } // /if
        
        
                    return false;
                }); // /submit categories form function
        

            }// /success
        });// /ajax function to fetch selected categories
    }// /if
}// /edit categories function 