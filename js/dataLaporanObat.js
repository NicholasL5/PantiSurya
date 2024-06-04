$(document).ready(function(){
    showdata();

    // on input change
    $("#search_input").on('input', function(){
        var searchValue = $(this).val().trim();
        showdata(searchValue);
    });

    function showdata(search_value = ""){
        const urlParams = new URLSearchParams(window.location.search);
        const idParam = urlParams.get('id');
        console.log(idParam); 
        $.ajax({
            url:"dataobat_proses.php",
            type:"POST",
            data:{
                search: search_value,
                id: idParam
            },
            success:function(result){
                $("#list_obat").html(result);

                delete_user();
            }
        })
        $.ajax({
            url:"dataobat_proses_unpaid.php",
            type:"POST",
            data:{
                search: search_value,
                id: idParam
            },
            success:function(result){
                $("#list_obat_unpaid").html(result);

                delete_user();
            }
        })
    }

    // $("#adduser").on("click", function(){
    //     alert("add");
    // })

    // function delete_user(){
    //     $(".del").on('click', function(){
    //         var conf = confirm("yakin delete?");
    //         var delbutton = $(this);
    //         if(!conf) return;

    //         $.ajax({
    //             url:"databerita_delete.php",
    //             type:"POST",
    //             data:{
    //                 delid: delbutton.data("rowid")
    //             },
    //             success:function(result){
    //                 if(result == "success") {
    //                     delbutton.closest('tr').remove();
    //                 }else{
    //                     alert("fail");  
    //                 }
    //             }
    //         })
    //     })
    // }

    


})