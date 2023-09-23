<?php

$conn = mysqli_connect('localhost:3306', 'root', '', 'pdfdata');
$sql = "SELECT * FROM csv_storage";
$result = mysqli_query($conn, $sql);
$csvFileName = "exported_data.csv";
$csvFile = fopen($csvFileName, 'w');  
fputcsv($csvFile, ["name", "nationality", "city","latitude","longitude","gender"]);
while ($row = mysqli_fetch_assoc($result)) {
    // fputcsv($csvFile, [$row['name'], $row['nationality'], $row['city'],$row['latitude'],$row['longitude'],$row['gender']]);
    fputcsv($csvFile, array_values($row));
}
fclose($csvFile);
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
readfile($csvFileName);
unlink($csvFileName);
mysqli_close($conn);
exit();

// njhjk
?>
