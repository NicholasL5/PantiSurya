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
            url:"datapondokkan_proses.php",
            type:"POST",
            data:{
                search: search_value,
                id: idParam
            },
            success:function(result){
                $("#list_pondokkan").html(result);

                delete_user();
            }
        })
        $.ajax({
            url:"datapondokkan_proses_unpaid.php",
            type:"POST",
            data:{
                search: search_value,
                id: idParam
            },
            success:function(result){
                $("#list_pondokkan_unpaid").html(result);

                delete_user();
            }
        })
    }



    


})