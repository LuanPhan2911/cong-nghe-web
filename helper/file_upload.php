<?php
function upload_file($file, $target)
{
    $dir = "images/" . $target;
    $time = time();
    $key = "291103";
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = $time . basename($file['name']);

    $path = $dir . hash_hmac("sha256", $file_name, $key);
    $path = $path . ".$ext";
    move_uploaded_file($file['tmp_name'], $path);
    return $path;
}
function remove_file($target)
{
    return unlink($target);
}
