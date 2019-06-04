<!DOCTYPE html>

<?php
require_once("autoload.php");
if (isset($_GET["id"])) {
  $id_pelicula=$_GET["id"];
  $query = $pdo->prepare("select movies.id, movies.title, movies.rating, movies.release_date from movies where movies.id = '$id_pelicula'");
  $query->execute();
  $pelicula=$query->fetch(PDO::FETCH_ASSOC);

}

if (isset($_POST["modificar"])) {
    foreach ($_POST as $key => $value) {
    $sql="UPDATE movies SET $key='$value' where movies.id=:id";
    $query=$pdo->prepare($sql);
    $query->bindValue(':id',$_POST['id']);
    $query->execute();
    header('Location:TablaMovies.php');
    }
  } elseif (isset($_POST["no"])){
      header('Location:peliculas.php');
      exit;
  }

 ?>
<html lang="en" dir="ltr">
  <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<div class="container ">
    <h1><?= $pelicula["title"] ;?></h1>
    <br>
    <h3>ID: <?= $pelicula['id']?></h3>
      <?php foreach ($pelicula as $key => $value) : ?>
          <?php if ($key!=="id"){;?>
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm"><?= $key?> :</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="<?= $key?>" value="<?= $value?>">
            </div>
          <?php } ?>
          </br>
      <?php endforeach;?>

        <p class="text-primary">Esta seguro que quieres modificar esta pelicula?</p>
        <form class="" action="" method="post">
          <input class="btn btn-primary" type="submit" name="modificar" value="si">
          <input class="btn btn-primary" type="submit" name="no" value="no">
          <input class="btn btn-primary" type="hidden" name="id" value="<?=$id_pelicula;?>">
       </form>

</div>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
