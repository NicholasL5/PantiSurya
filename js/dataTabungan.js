$(document).ready(function(){
    showdata();

    // on input change
    $("#search_by_name").on('input', function(){
        var searchValue = $(this).val().trim();
        showdata(searchValue);
    });

    
})


function showdata(search_value = ""){

    $.ajax({
        url:"keuangan_tabungan_proses.php",
        type:"POST",
        data:{
            search: search_value
        },
        success:function(result){
            $("#list_tabungan").html(result);

            view_laporan();
        }
    })
}

function view_laporan(){
    $(".view").on("click", function() {
        var rowid = $(this).data("rowid");
        window.location.href = "laporanTabungan.php?id=" + rowid;
    })
}