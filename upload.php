<?php

if(!empty($_FILES['images']['name'][0])){

    $images = $_FILES['images'];

    $uploaded = array();
    $failed = array();

    $allowed = array('jpg', 'png', 'gif');

    foreach ($images['name'] as $position => $image_name){

        $image_tmp = $images['tmp_name'][$position];
        $image_size = $images['size'][$position];
        $image_error = $images['error'][$position];

        $image_ext = explode('.', $image_name);
        $image_ext = strtolower(end($image_ext));

        if (in_array($image_ext, $allowed)){

            if($image_error === 0){

                if ($image_size <= 1000000){

                    $image_name_new = uniqid('.', true) . '.' . $image_ext;
                    $image_destination = 'uploads/' . $image_name_new;

                    if (move_uploaded_file($image_tmp, $image_destination)){
                        $uploaded[$position] = $image_destination;
                    } else {
                        $failed[$position] = "[{$image_name}] n\'a pas pu être téléchargée";
                    }

                } else {
                    $failed[$position] = "[{$image_name}] est trop grande.";
                }

            } else {
                $failed[$position] = "[{$image_name}] a rencontré une erreur {$image_error}.";
            }

        } else {
            $failed[$position] = " [{$image_name}] l\'extension '{$image_ext}' n\'est pas autorisée.";
        }
    }

    if (!empty($uploaded)){
        var_dump($uploaded);
    }

    if (!empty($failed)){
        var_dump($failed);
    }
}