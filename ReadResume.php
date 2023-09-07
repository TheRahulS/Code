<?php
require 'vendor/autoload.php'; // Include the Composer autoloader

use Smalot\PdfParser\Parser;

$filePath = 'Rahul.pdf';

// Create a PDF parser object
$parser = new Parser();
$pdf = $parser->parseFile($filePath);

if ($pdf) {
    // Extract text content from the PDF
       $text = $pdf->getText();
    echo $text;
    }
    ?>
   
    
    
  
    
