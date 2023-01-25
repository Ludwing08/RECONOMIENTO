<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Proyecto Mineros</title>

    <script src="js/jquery.js"> </script>
</head>

<body>
    <div class="container-fluid">
        <a class="btn btn-warning position-absolute top-0 start-3 mt-3" href="reportes/reporte.php" target="_blank" style="color: black;">
            <b> Reporte</b>
        </a>

        <form action="../Servicios/buscar.php" method="post">


            <div class="row align-items-center">
                <div class="col-5 d-flex align-items-center shadow p-3 bg-body rounded" id="panel">
                    <img src="img/logo1.png" alt="logo" style="width: 50%; height: 50%;">
                    <div class="h1">Reconocimiento de equipo de seguridad</div>
                </div>

                <div class="col-7">

                    <div class="row ps-5 pe-5 mb-3">
                        <div class="col-9 align-self-center">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="Cedula" id="Cedula" placeholder="Cédula">
                                <label for="Cedula">Cédula</label>
                            </div>
                        </div>
                        <div class="col-3 align-self-center">
                            <input name="buscar" id="buscar" class="btn btn-outline-primary" style="width: 100%; height: 100%;" value="Buscar" type="button">
                        </div>
                    </div>

                    <!-- <div class="row ps-5 pe-5">
                        <div class="col">
                            <label for="inputNombre" class="form-label"><b> Nombre </b></label>
                            <input type="text" class="form-control p-3" placeholder="Nombre" aria-label="inputNombre">
                        </div>
                        <div class="col">
                            <label for="inputApellido" class="form-label"> <b> Apellido </b></label>
                            <input type="text" class="form-control p-3" placeholder="Apellido"
                                aria-label="inputApellido">
                        </div>
                    </div> -->
                </div>

            </div>
    </div>

    </form>

</body>


</html>