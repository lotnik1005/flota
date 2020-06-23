<?php
require_once('sql_connect.php');

function generate_dashboard() {
    global $mysqli;

    $sql = "SELECT trucks.name AS truck, drivers.name AS driver
            FROM trucks
            INNER JOIN drivers
            ON trucks.driver_id = drivers.id";

    $result = $mysqli->query($sql);
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return $rows;
}

function generate_table($param) {
    global $mysqli;

    if($param == 'trucks') {
        $sql = "SELECT id, name FROM trucks";
    } else {
        $sql = "SELECT id, name FROM drivers";
    }

    $result = $mysqli->query($sql);

    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return $rows;
}

function generate_trucks() {
    global $mysqli;

    $sql = "SELECT id, name FROM trucks";

    $result = $mysqli->query($sql);

    $rows = $result->fetch_all(MYSQLI_ASSOC);

    return $rows;
}

function delete($param, $id) {
    global $mysqli;

    if($param = "drivers") {
        $sql = "DELETE from drivers WHERE id = ?";
    } 

    if($param = "trucks") {
        $sql = "DELETE FROM trucks WHERE id = ?";
    }

    if($statement = $mysqli->prepare($sql)) {
        if($statement->bind_param('i', $id)) {
            $statement->execute();
            header("Location: ../dashboard.php");
        } else {
            die('Param binding error');
        }
    } else {
        die("Incorrect query");
    }
    
}

// mini system zarządzania 35 minuta