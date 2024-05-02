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

    // $("#adduser").on("click", function(){
    //     alert("add");
    // })

    function delete_user(){
        $(".del").on('click', function(){
            var conf = confirm("yakin delete?");
            var delbutton = $(this);
            if(!conf) return;

            $.ajax({
                url:"pendudukdata_delete.php",
                type:"POST",
                data:{
                    delid: delbutton.data("rowid")
                },
                success:function(result){
                    if(result == "success") {
                        delbutton.closest('tr').remove();
                    }else{
                        alert("fail");  
                    }
                }
            })
        })
    }

    


})