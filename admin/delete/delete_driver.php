<?php
if(!empty($_GET)) {
    $driver_id = $_GET['id'];

    echo $driver_id;

    require_once('../functions.php');

    delete("drivers", $driver_id);
}