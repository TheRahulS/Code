<?php

require 'vendor/autoload.php'; // Include the Composer autoloader

use Smalot\PdfParser\Parser;
$servername='localhost:3306';
$host='root';
$password="";
$db='pdfdata';
$conn=mysqli_connect($servername,$host,$password,$db);
$filepath='dataset.pdf';

$parser=new Parser();
$pdf=$parser->parseFile($filepath);
if($pdf){
    $text=$pdf->getText();
//    echo $text;
   $rows = explode("\n", $text);
   echo "<pre>";
   print_r($rows);
   echo "</pre>";
//    print_r($rows);
    
  
   $headerSkipped = false;
   
   foreach ($rows as $row) {
       if (!$headerSkipped) {
           $headerSkipped = true;
           continue; // Skip the header row
       }
       
       $columns = str_getcsv($row);
      print_r($columns);
      
       // Assuming your CSV has three columns: column1, column2, column3
       $column1 = $columns[0];
       $column2 = $columns[1];
      
       $column3 = $columns[2];
       $column4= $columns[3];
       $column5= $columns[4];
       
 
       $sql = "INSERT INTO pdfstorage (column1, column2, column3,column4,column5) VALUES ('$column1', '$column2', '$column3','$column4','$column5')";
       echo $sql;
       die();
       if (mysqli_query($conn, $sql)) {
           echo "Record inserted successfully!";
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }
   }
   
   // Close the database connection
   mysqli_close($conn);
}


?>