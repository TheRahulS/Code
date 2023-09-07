<?php
$conn = mysqli_connect("localhost:3306", "root", "", "pdfdata");
if ($conn) {
    echo "connection successfully";
} else {
    echo "connected not successfully" . mysqli_connect_error();
}
$filepath = 'student-dataset.csv';
if (($handle = fopen($filepath, 'r')) !== false) {
    $n = 1;
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        if ($n == 1) {
            $n++;
            continue;
        }
        $sql = "insert into csv_storage  values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
        $result = mysqli_query($conn, $sql);
       
        $n++;
    }
    if ($result) {
        echo "data inserted successfully";
    } else {
        echo "data not inserted successfully";
    }
    fclose($handle);
}
?>