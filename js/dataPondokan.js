$(document).ready(function(){
    showdata();

    // on input change
    $("#search_input").on('input', function(){
        var searchValue = $(this).val().trim();
        showdata(searchValue);
    });

    
})

function showdata(search_value = ""){
    $.ajax({
        url:"pendudukdata_proses.php",
        type:"POST",
        data:{
            search: search_value
        },
        success:function(result){
            $("#tabelPondokan").html(result);

            delete_user();
        }
    })
}