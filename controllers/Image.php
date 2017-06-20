<?php
/**
 * Created by PhpStorm.
 * User: mehdy
 * Date: 20/06/17
 * Time: 13:17
 */

namespace Controllers;


class Image
{
    public function handleImageUpload($name)
    {
        if (isset($_FILES[$name])) {
            if (!$_FILES[$name]['error']) {
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (in_array($_FILES[$name]['type'], $allowedTypes)) {
                    $typeParts = explode('/', $_FILES[$name]['type']);
                    $ext = '.' . $typeParts[count($typeParts) - 1];
                    $sourceFile = $_FILES[$name]['tmp_name'];
                    $destFile = './assets/f' . time() . rand(1000, 9999) . $ext;
                    $requiredWidth = 350;

                    list($srcW, $srcH) = getimagesize($_FILES[$name]['tmp_name']);

                    if ($_FILES[$name]['type'] === 'image/png') {
                        $srcResource = imagecreatefrompng($_FILES[$name]['tmp_name']);
                    } else {
                        $srcResource = imagecreatefromjpeg($_FILES[$name]['tmp_name']);
                    }

                    $ratio = $requiredWidth / $srcW;
                    $destW = $srcW * $ratio;
                    $destH = $srcH * $ratio;

                    $destResource = imagecreatetruecolor($destW, $destH);
                    imagecopyresampled($destResource, $srcResource, 0, 0, 0, 0, $destW, $destH, $srcW, $srcH);

                    if ($_FILES[$name]['type'] === 'image/png') {
                        imagepng($destResource, $destFile, 9);
                    } else {
                        imagejpeg($destResource, $destFile, 100);
                    }
                    return $destFile;
                } else {
                    $_SESSION['error'][] = 'Ce type de fichier image n\'est pas accepté';
                }
            }
        }
    }
}