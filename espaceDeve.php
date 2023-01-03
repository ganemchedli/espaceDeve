<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Insert PDF</title>
     <!--<style media="screen">
      div{
        border: 2px solid black;
        width: 500px;
        margin-left: 370px;
        margin-top: 50px;
        padding: 30px;
      }
      form{
        margin-left: 70px;
      }
      label{
        font-size: 25px;
        font-weight: bold;
      }
      #pdf{
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
      }
      #upload{
        font-size: 20px;
        font-weight: bold;
        margin-left: 100px;
      }
    </style>-->
  </head>
  <body>
    <h1>Espace de la Direction des Etudes et de la Vie étudiante</h1>
    <div class="">
      <form class="form"  action="espaceDeve.php" method="post" enctype="multipart/form-data">
        <h2>Search project</h2><br>
        <input type="text" name="search" placeholder="type project id">
       <!-- <input id="pdf" type="file" name="pdf" value="" required><br><br>-->
       <button> <input id="upload" type="submit" name="submit" value="Submit"> </button> 

       </form>
      <?php
include 'db.php';
session_start();
if (isset($_POST['submit'])&&!empty($_POST['search'])) {
    /*$pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="pdf/".$pdf;
    echo $pdf_tem_loc;
    move_uploaded_file($pdf_tem_loc,$pdf_store);
    $sql="INSERT INTO deve (matricule, sujet, fichier, approuve, description) values(1,'a','$pdf','a','a')";
    $query=mysqli_query($conn,$sql);*/
    $_SESSION['search']=$_POST['search'];
    $mat = $_POST['search'];
    $sql = "select * from  deve where matricule=$mat";
    $query = mysqli_query($conn, $sql);
    ?>
         <table class="table" style="border-collapse: collapse;
    margin-left:45%; font-family:'Montserrat',sans-serif; width:200px;">
            <tbody>
            <?php
while ($info = mysqli_fetch_array($query)) {

        ?>
            <tr>
                <td style="border-bottom: 1px solid #ddd; padding: 8px;"> Sujet :<?php echo $info['sujet']; ?></td>
            </tr>
            <tr>
            <td style="border-bottom: 1px solid #ddd; padding: 8px;"> Fichier :<a href="afficherPdf.php" target="_blank"><button ><?php echo $info['fichier']; ?></button></a></td>
            </tr>

                <tr>
                <td style="border-bottom: 1px solid #ddd; padding: 8px; "> Approuvé :<?php 
                if($info['approuve']==1)
                {echo "oui";}
                else
                {
                  echo "non";
                } ?></td>
                
                 
                </tr>
                <tr>
                <td style="border-bottom: 1px solid #ddd; padding: 8px;"> Descritpion :<?php echo $info['description']; ?></td>
                </tr>
                <tr>
                <td style="border-bottom: 1px solid #ddd; padding: 8px;"> Id enseignant :<?php echo $info['id_en']; ?></td>
                </tr>

            </tbody>
         </table>
         
         <?php }?>
         <form action="espaceDeve.php" method="post">
         <table  style="margin-left: 45%;">
          <tr>
            <td><button type="submit" name="app">Approuvé</button></td>
            <td><button type="submit"name="diapp">Disapprouvé</button></td>
         
          </tr>
          
            
         </table>
         </form>
         </table>
    </div>
         <?php
         
        }?>
        <table>
    
       
<?php 
if(isset($_POST['app']))
{
  $mat=$_SESSION['search'];
 $sql1="UPDATE deve set approuve=1 where matricule=$mat";
mysqli_query($conn,$sql1);
}
if(isset($_POST['diapp']))
{
  $mat=$_SESSION['search'];
 $sql2="UPDATE deve set approuve=0 where matricule=$mat";
$query1=mysqli_query($conn,$sql2);
}
?>
  </body>
</html>