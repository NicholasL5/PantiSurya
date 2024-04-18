$(document).ready(function(){
    show_pengobatan();




    function show_pengobatan(){
        $.ajax({
            url:'penduduk_pengobatan_proses.php',
            type: "POST",
            data:{},
            success:function(result){
                
            }

        })
    }

    function check_sudah_bayar(){
        $(".check-bayar").on('click', function(){
            var conf = confirm("yakin ganti?");
            var check_button = $(this);
            if (!conf) return;

            

        })
    }
})