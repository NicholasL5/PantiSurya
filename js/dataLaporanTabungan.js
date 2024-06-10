
function showdata(idParam){
    $.ajax({
        url:"dataTabungan_proses.php",
        type:"POST",
        data:{
            id: idParam
        },
        success: function(result){
            $("#list_tabungan").html(result);

        }
    })
}