<?php
  session_start();

  if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    die('No acces available');
  }

  require_once('functions.php');
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>
<body>
  <div class="container-fluid bg-dark p-4">
    <div class="row">
      <h3 class="text-center mt-3 mb-3 text-light">Kierowcy i ciężarówki</h3>
    </div>
  </div>
  <div class="container p-3 mt-4">
    <h2 class="text-center p-4">Raport</h2>
    <div class="row">
      <table class="table table-striped mt-4">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Kierowcy</th>
            <th scope="col">Ciężarówki</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $rows = generate_dashboard();

            for($i=0; $i<count($rows); $i++) {
              echo "<tr>";
              echo "<th scope='col'".($i+1)."</th>";
              echo "<td>".$rows[$i]['driver']."</td>";
              echo "<td>".$rows[$i]['truck']."</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container-fluid bg-dark">
    <div class="row">
      <div class="col-6 p-5">
        <table class="table text-light">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Ciężarówka</th>
              <th scope="col">Usuń</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $rows = generate_trucks();

              for($i=0; $i<count($rows); $i++) {
                echo "<tr>";
                echo "<th scope='col'>".($i+1)."</th>";
                echo "<td>".$rows[$i]['name']."</td>";
                echo "<td><button class='btn btn-danger' onclick='(function(){location.href=\"delete/delete_truck.php?id=".$rows[$i]['id']."\"});'>x</button></td>";
              }
            ?>
          </tbody>
        </table>
        <form action="trucks.php" enctype="multipart/form-data" method="POST" class="text-white d-flex justify-content-between align-items-center">
          <div class="forms">
            <p>
              Nazwa: <input type="text" name="truck" id="truck" placeholder="Nazwa" required>
            </p>
            <textarea name="description" id="description" cols="30" rows="3" placeholder="Opis"></textarea>
            <p>
              Zdjęcie: <input type="file" name="photo_truck" id="photo_truck" required>
            </p>
            <div class="mt-3">
              Kierowca: <select name="driver" id="driver">
                <option value="" disabled>Kierowca</option>
                <?php
                  $rows = generate_table('drivers');

                  for($i=0; $i<count($rows); $i++) {
                    echo "<option value=".$rows[$i]['id'].">".$rows[$i]['name']."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <button class="btn btn-success">Dodaj</button>
        </form>
      </div>
      <div class="col-6 p-5">
        <table class="table text-light">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Kierowca</th>
              <th scope="col">Usuń</th>
            </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
        <form action="drivers.php" enctype="multipart/form-data" method="POST" class="text-white d-flex justify-content-between align-items-center">
          <div class="forms">
            <p>
              Imię: <input type="text" name="driver" id="driver" placeholder="Imię">
            </p>
            <textarea name="description" id="description" cols="30" rows="3" placeholder="Opis"></textarea>
            <p>
              Zdjęcie: <input type="file" name="photo_driver" id="photo_driver" required>
            </p>
          </div>
          <button class="btn btn-success">Dodaj</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>

<!-- php i mysql mini system zarządzania 30 minuta-->

