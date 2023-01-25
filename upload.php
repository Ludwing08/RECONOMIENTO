<?php
if(isset($_FILES['images'])){
    $errors= array();
    $images = $_FILES['images'];
    $uploaded = array();
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    foreach($images['name'] as $position => $name){
        $file_tmp = $images['tmp_name'][$position];
        $file_size = $images['size'][$position];
        $file_error = $images['error'][$position];
        $file_name = $images['name'][$position];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        if(in_array($file_ext, $allowed)){
            if($file_error === 0){
                if($file_size <= 2097152){
                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'images/' . $file_name_new;
                    if(move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$position] = $file_destination;
                    }
                }
            }
        }
    }
    if(!empty($uploaded)){
        print_r($uploaded);
    }
}
?>
