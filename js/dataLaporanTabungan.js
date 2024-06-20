
function showdata(idParam){
    $.ajax({
        url:"dataTabungan_proses.php",
        type:"POST",
        data:{
            id: idParam
        },
        success: function(result){
            $("#list_tabungan").html(result);

            delItem(idParam);
        }
    })
}

function delItem(idParam){


$(".del").on('click', function(){
    var delbutton = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"tabungandata_delete.php",
                type:"POST",
                data:{
                    delid: delbutton.data("rowid"),
                    penid: idParam
                },
                success:function(result){
                    if(result == "success") {
                        delbutton.closest('tr').remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Tabungan berhasil di delete.",
                            icon: "success"
                        });
                    }else{
                        Swal.fire({
                            title:"Error!",
                            text: "Error in deleting tabungan",
                            icon: "error"
                        });
                    }
                },
                error:function(){
                    Swal.fire({
                        title: "Error!",
                        text: "There was a problem with the request.",
                        icon: "error"
                    });
                }

            });
        }

    });

});

}