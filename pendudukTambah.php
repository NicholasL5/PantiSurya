<?php
    session_start();
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="layout/styleTambah.css">
    <title>Panti Surya | Tambah Penduduk</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>Tambah Penduduk</h2>

                <section>
                <h4>Data Penduduk</h4>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama Penghuni:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat Lahir:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Agama:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Kristen Protestan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Katolik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Islam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Buddha
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            Hindu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" >
                        <label class="form-check-label" for="flexRadioDefault6">
                            Kong Hu Cu
                        </label>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat tinggal:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                </section>

                <section>
                <h4>Data Penanggung Jawab 1</h4>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama Penanggung Jawab:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat Lahir:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Agama:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Kristen Protestan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Katolik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Islam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Buddha
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            Hindu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" >
                        <label class="form-check-label" for="flexRadioDefault6">
                            Kong Hu Cu
                        </label>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat tinggal:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                </section>

                <section>
                <h4>Data Penanggung Jawab 2</h4>
                <p>Opsional</p>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama Penghuni:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat Lahir:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Agama:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Kristen Protestan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Katolik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Islam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Buddha
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            Hindu
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" >
                        <label class="form-check-label" for="flexRadioDefault6">
                            Kong Hu Cu
                        </label>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat tinggal:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                </section>  
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="button">Button</button>
                
                </div>
                

            
            </div>


        </div>
    </div>
    


    <script>
        feather.replace()
    </script>
</body>
</html>