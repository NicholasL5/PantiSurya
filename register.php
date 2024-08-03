<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include "layout/stylejquerynbs5.php" ?>
    <link rel="stylesheet" href="layout/styleLogin.css">
    <link rel="stylesheet" href="layout/style3.css">

    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya</title>
</head>

<body>
    <div class="container-fluid fullh flex-center">
        <div class="holder2">
            <form id="register" method="POST">
                <div class="login2 flex-center align-items-center justify-content-center">
                    <h1>Masukkan username dan password</h1>
                    <input type="text" name="username" class="form-control" id="loginuser" placeholder="Username">
                    <input type="password" name="password" class="form-control" id="loginpassword" placeholder="Password">
                    <input type="password" name="cpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password">
                    <div>
                        <div class="d-flex">
                            <button type="submit" name="register" class="btn btn-primary bg-blue">Register</button>
                            <a type="button" href="index.php" name="back" class="btn btn-danger bg-blue">Back</a>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $("#register").submit(function(event){
                event.preventDefault();

                    var formData = {
                        username: $("#loginuser").val(),
                        password: $("#loginpassword").val(),
                        cpassword: $("#confirmpassword").val()
                    };


                $.ajax({
                    type: "POST",
                    url: "register_process.php",
                    data: formData,
                    dataType: "json",
                    success: function(response){
                        if(response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Registration failed: ' + response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        // Handle error response with SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });

            });

        });
    </script>
</body>

</html>