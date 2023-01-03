<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display PDF</title>
    <style media="screen">
      
      
    </style>
  </head>
  <body>
      <?php
      include 'db.php';

      $sql="SELECT fichier from deve";
      $query=mysqli_query($conn,$sql);
      while ($info=mysqli_fetch_array($query)) {
        ?>
    <embed type="application/pdf" src="pdf/<?php echo $info['fichier']?>" width="100%" height="1000px">
    <?php
      }
      ?>

  </body>
</html>