<?php
if (!empty($_POST)) {
    $name = trim($_POST['truck']);
    $driver_id = trim($_POST['driver']);
    $description = trim($_POST['description']);

    if (!empty($_FILES)) {
        $targetDir = "trucks/";
        $targetFile = $targetDir . basename($_FILES['photo_truck']['name']);
        $imgType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (file_exists($targetFile)) {
            die('File is already exists');
        }

        if ($_FILES['photo_truck']['size'] > 500000) {
            die('Image is too big!');
        }

        if ($imgType != 'jpeg' && $imgType != 'jpg' && $imgType != 'png') {
            die('Image format is not correct');
        }

        if (move_uploaded_file($_FILES['photo_truck']['tmp_name'], $targetFile)) {
            require_once('sql_connect.php');
            
            $sql = "INSERT INTO trucks (name, phot_url, description, driver_id) VALUES (?, ?, ?, ?)";
            if ($statement = $mysqli->prepare($sql)) {
                if ($statement->bind_param('sssi', $name, $targetFile, $description, $driver_id)) {
                    if ($statement->execute()) {
                        header("Location:dashboard.php");
                    } else {
                        die('Error');
                    }
                }
            } else {
                die('Incorrect query');
            }
        } else {
            die('Your file hasnt been uploaded');
        }
    }
}
