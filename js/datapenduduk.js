$(document).ready(function(){
    showdata();

    // on input change
    $("#search_input").on('input', function(){
        var searchValue = $(this).val().trim();
        showdata(searchValue);
    });

    function showdata(search_value = ""){
        $.ajax({
            url:"pendudukdata_proses.php",
            type:"POST",
            data:{
                search: search_value
            },
            success:function(result){
                $("#list_siswa").html(result);

                delete_user();
            }
        })
    }


    function delete_user(){
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
                        url:"pendudukdata_delete.php",
                        type:"POST",
                        data:{
                            delid: delbutton.data("rowid")
                        },
                        success:function(result){
                            if(result == "success") {
                                delbutton.closest('tr').remove();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            }else{
                                Swal.fire({
                                    title:"Error!",
                                    text: "Error in deleting penduduk",
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

    


})