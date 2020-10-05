<?php
sleep(5);
header('Content-Type: application/json; charset=utf-8');

$stuff = array(
    "first" => "first Thing",
    "second" => "second thing",
);

echo (json_encode($stuff));
?>