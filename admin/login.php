<?php
    /*$nick = $_POST['Nick'];
    $password = $_POST['Password'];
    echo $nick;
    echo "<br>";
    echo $password;*/
    if(!empty($_POST)) {
        // uruchamiamy sesje
        session_start();

        if(isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
            header("location: dashboard.php");
        }

        require_once('sql_connect.php');

        $nick = trim($_POST['Nick']);
        $password = hash('whirlpool', trim($_POST['Password']));

        if($nick == '' || $password == '') {
            die('Nick lub hasło jest puste');
        }

        // przygotowanie zapytania
        $sql = "SELECT password FROM users WHERE name=?";

        if($statement = $mysqli->prepare($sql)) {
            if($statement->bind_param('s', $nick)) {
                $statement->execute();
                $result = $statement->get_result();
                $row = $result->fetch_row();
                $user_password = $row[0];

                if($password == $user_password) {
                    session_start();
                    $_SESSION['logged'] = true;
                    header('location: dashboard.php');
                } else {
                    die('Password incorrect');
                }
            }
        } else {
            die('Incorrect query');
        }
    } else {
       die('No data sent'); 
    }
?>