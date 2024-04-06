<?php
    
    session_start();
    if(!isset($_COOKIE['user_login'])){
        header("location:login2.php");
    }


    require 'connection.php';

    $query = "SELECT * FROM siswa";
    $res = $pdo->query($query);

    // if($res->num_rows > 0){

    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Document</title>
</head>
<body>
    <script>
        $(document).ready(function(){
            showdata();

            // on input change
            $("#search_input").on('input', function(){
                var searchValue = $(this).val().trim();
                showdata(searchValue);
            });

            function showdata(search_value = ""){
                $.ajax({
                    url:"datasiswa_proses.php",
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

            $("#adduser").on("click", function(){
                alert("add");
            })

            function delete_user(){
                $(".del").on('click', function(){
                    var conf = confirm("yakin delete?");
                    var delbutton = $(this);
                    if(!conf) return;

                    $.ajax({
                        url:"datasiswa_delete.php",
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
    </script>




    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <h1>Data Penduduk</h1>
                
                <div class="table-nav wfull">
                    <form class="d-flex" role="search" action="datasiswa.php" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Cari Penduduk" id="search_input" aria-label="Search" style="border: 1px solid rgb(0,0,0,0.5);">
                    </form>

                    <div class="button-group">
                        <button type="button" class="btn btn-outline-primary" id="adduser">Add User</button>
                    </div>
                    
                </div>

                <div class="content">
                    <table class="table wfull table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            
                            <th scope="col">Email Wali</th>
                            <th scope="col">No Telp Wali</th>
                            <th scope="col">Pengobatan Terakhir</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_siswa">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    



    <script>
        feather.replace();
    </script>
</body>
</html>