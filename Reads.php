<?php
require 'vendor/autoload.php'; // Include the Composer autoloader

use Smalot\PdfParser\Parser;

// Replace these with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "pdfdata";

// Connect to the database
$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Replace 'your_pdf_file.pdf' with the path to your PDF file
$filePath = 'Rahul.pdf';

// Create a PDF parser object
$parser = new Parser();
$pdf = $parser->parseFile($filePath);

if ($pdf) {
    // Extract text content from the PDF
    $text = $pdf->getText();

    // Get the filename from the path
    $filename = basename($filePath);

    // Store the PDF content and filename in the database
    $text = $mysqli->real_escape_string($text);
    $filename = $mysqli->real_escape_string($filename);

    $query = "INSERT INTO pdf_storage (filename, content) VALUES ('$filename', '$text')";

    if ($mysqli->query($query)) {
        echo "PDF content and filename stored successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Failed to parse the PDF file.";
}

// Close the database connection
$mysqli->close();
?>
