<?php
include_once("code.php");

if(count($argv) < 2) {
    $bikini = new Account();
    $bikini->files_function();
}
else
{
    echo $argv[1];
}
?>