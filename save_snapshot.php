<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    

    $image = $_POST['image'];
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $data = base64_decode($image);
    $path1='interfaz/reportes/images/';    
    $path2='foto';
    $ext = '.png';
    $contador = random_int(1,100000);
    $file = $path1.$path2.$contador++.$ext;
    // $file = 'images/aa.$contador.png';
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';
?>
