<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_aqiqahfithrah";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM packages";
$result = $conn->query($sql);

$packages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

$conn->close();

echo json_encode($packages);
?>
