<?php
function upload_file($file, $target)
{
    $dir = "assets/images/";
    $time = time();
    $key = "291103";
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = $time . basename($file['name']);

    $path = $target . hash_hmac("sha256", $file_name, $key) . ".$ext";
    move_uploaded_file($file['tmp_name'], $dir . $path);
    return $path;
}
function remove_file($target)
{
    return unlink("assets/images/" . $target);
}
