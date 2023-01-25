<?php

include ('Servicios/conexion.php');

$Cedula = $_REQUEST['Cedula'];
// $Cedula = '1804567891';
$query = "SELECT * FROM empleado WHERE CED_EMP = '$Cedula'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $empleado = $result->fetch_assoc();
    $nombre = $empleado['NOM_EMP'];
    $cedula = $empleado['CED_EMP'];

    $hoy = date("Y-m-d H:i:s");     

    $image = $_POST['image'];
    $casco= $_POST['casco'];
    $image = str_replace('data:image/png;base64,', '', $image);
    // $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);
    $path1='interfaz/reportes/images/';
    $path2='foto';
    $ext = '.png';
    $contador = random_int(1,100000);
    $file = $path1.$path2.$contador++.$ext;
    // $file = 'images/aa.$contador.png';
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';
  
    $sqlInsert = "INSERT INTO registro_empleado (CED_EMP, FECHA_ENTRADA, CASCO,CHALECO, BOTAS, OBSERVACION, IMAGEN_NOMBRE, PATH) VALUES ('$Cedula', '$hoy' , '$casco', 0,0, 'Ninguna', '$image', '$file')";
    // mysqli_query($conn, $sqlInsert);
    if (($result = mysqli_query($conn, $sqlInsert)) === false) {
      die(mysqli_error($conn));
    }
    
    echo json_encode($empleado);    
} else {
    http_response_code(404);

    // header("Location: http://localhost/PROYECTO_MINEROS/interfaz/index.php");
    echo json_encode(['error' => 'Empleado no encontrado']);
}



  // $Cedula = $_REQUEST['Cedula'];
// $Cedula = '1804567891';
// $variable_js = $_REQUEST['cam_input'];
 
function cedula(){
  $GLOBALS['Cedula'];
}

