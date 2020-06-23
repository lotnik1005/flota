<?php
if (!empty($_POST)) {
    $name = trim($_POST['driver']);
    $description = trim($_POST['description']);

    if (!empty($_FILES)) {
        $targetDir = "drivers/";
        $targetFile = $targetDir . basename($_FILES['photo_driver']['name']);
        $imgType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (file_exists($targetFile)) {
            die('File is already exists');
        }

        if ($_FILES['photo_driver']['size'] > 500000) {
            die('Image is too big!');
        }

        if ($imgType != 'jpeg' && $imgType != 'jpg' && $imgType != 'png') {
            die('Image format is not correct');
        }

        if (move_uploaded_file($_FILES['photo_driver']['tmp_name'], $targetFile)) {
            require_once('sql_connect.php');

            $sql = "INSERT INTO drivers (name, photo_url, description) VALUES (?, ?, ?)";
            if ($statement = $mysqli->prepare($sql)) {
                if ($statement->bind_param('sss', $name, $targetFile, $description)) {
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

// 50 minuta