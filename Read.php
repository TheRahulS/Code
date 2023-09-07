<?php
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
$filePath = 'file.pdf';

// Get the filename from the path
$filename = basename($filePath);

// Open the PDF file
$pdfFile = fopen($filePath, 'rb');

if ($pdfFile) {
    $content = '';

    // Read the PDF file and store its content
    while (!feof($pdfFile)) {
        $content .= fread($pdfFile, 8192); // Read 8KB at a time
    }

    // Close the PDF file
    fclose($pdfFile);

    // Store the PDF content and filename in the database
    $content = $mysqli->real_escape_string($content);
    $filename = $mysqli->real_escape_string($filename);

    $query = "INSERT INTO pdf_storage (filename, content) VALUES ('$filename', '$content')";

    if ($mysqli->query($query)) {
        echo "PDF content and filename stored successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Failed to open the PDF file.";
}

// Close the database connection
$mysqli->close();
?>
