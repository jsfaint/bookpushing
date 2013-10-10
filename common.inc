<?php
function _post($str)
{
    if (empty($_POST[$str])) {
        return null;
    } else {
        return $_POST[$str];
    }
}

function _get($str)
{
    if (empty($_GET[$str])) {
        return null;
    } else {
        return $_GET[$str];
    }
}

$http_base="/mnt/sda1/http";
$book_dir=$http_base . "books";
?>
