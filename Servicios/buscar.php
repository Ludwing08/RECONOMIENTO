<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include "conexion.php";


    $Cedula = $_REQUEST['Cedula'];
    $query = "SELECT * FROM empleado WHERE CED_EMP = '$Cedula'";
    $result = $conn->query($query);    

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $nombre = $product['NOM_EMP'];
        $cedula = $product['CED_EMP'];
        // echo $nombre;
        // echo json_encode($product);
        header("Location: http://localhost/PROYECTO_MINEROS/interfaz/camara.php?Cedula=$cedula");
    } else {
        http_response_code(404);

        header("Location: http://localhost/PROYECTO_MINEROS/interfaz/index.php");
        //echo json_encode(['error' => 'Empleado no encontrado']);
    }
