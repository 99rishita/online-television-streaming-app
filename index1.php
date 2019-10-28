<!DOCTYPE html>
<html>
<head>
    <title>Search Bar using PHP</title>
    <style>
      table,th,td{
       border: 3px solid black;
       border-collapse:collapse;
      }
      th,td{
       padding:10px;
      }
    </style>
    
</head>
<body>
 
<form method="post">
<label>Search</label>
<input type="text" name="search">
<input type="submit" name="submit">
     
</form>
 
</body>
</html>
 
<?php
 
$con = new PDO("mysql:host=localhost;dbname=project",'root','');
 
if (isset($_POST["submit"])) {
    $str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM `content` WHERE title = '$str'");
    
 
    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth -> execute();
 

    if($row = $sth->fetch())
    {
        ?>
        <br><br><br>
        <table>
            <tr>
                <th>title</th>
                <th>genre</th>
                
            </tr>
            <tr>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->genre; ?></td>
            </tr>
 
        </table>
       
<?php 
    }
    
         
         
        else{
            echo "title Does not exist";
        }
 
 
}
if (isset($_POST["submit"])) {
    $str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM `content` WHERE genre = '$str'");
    
 
    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth -> execute();
 

    if($row = $sth->fetch())
    {
        ?>
        <br><br><br>
        <table>
            <tr>
                <th>title</th>
                <th>genre</th>
                
            </tr>
            <tr>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->genre; ?></td>
            </tr>
 
        </table>
       
<?php 
    }
    
         
         
        else{
            echo "genre Does not exist";
        }
}
 
?>