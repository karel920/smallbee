$(document).ready(function() {

    $('#dataTable').dataTable();

    $("#dataTable").on("click", '#upload_file', function(event) {
        
        var resId = $(this).attr("data-resId");
        $('#resource_id').val(resId);
        $('#update_resource').modal('show');
    });

    $('#btn_new_resource').click(e => {
        
        $('#new_resource').modal('show');
    })
})