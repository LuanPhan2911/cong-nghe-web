<?php



function upload_file($file, $target)
{

    $dir = str_replace("\\", "/", __DIR__);

    $time = time();
    $key = "291103";
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = $time . basename($file['name']);

    $path = $target . hash_hmac("sha256", $file_name, $key) . ".$ext";
    $dir = "$dir/../assets/images/" . $path;
    move_uploaded_file($file['tmp_name'], $dir);
    return $path;
}
function remove_file($target)
{
    $dir = str_replace("\\", "/", __DIR__);

    return unlink("$dir/../assets/images/" . $target);
}
