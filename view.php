<?php
$conn=mysqli_connect('localhost:3306','root','','pdfdata');
$sql="select * from csv_storage";
$result=mysqli_query($conn,$sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<button id="export"><a href="exportdata.php">exportdata</a></button>
<body>
    <table border="1px solid black">
       <tr>
       <th>name</th>
        <th>nationality</th>
        <th>city</th>
       </tr>
<?php

while($row=mysqli_fetch_assoc($result)){ ?>


    <tr>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['nationality'] ?></td>
     <td><?php echo $row['city'] ?></td>
       </tr>
       <?php
}
    ?>
    </table>


</body>
</html>