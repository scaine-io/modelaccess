<?php
header('Access-Control-Allow-Origin: *');
$video = $_GET['id'];
$sound = $_GET['sound'];
$node = $_GET['node'];

$servername = "localhost";
$username = "script";
$password = "tomiscrazy";
$dbname = "scaine";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO projects (node, id, sound, complete, final, movieFile, soundFile)
VALUES ('$node', '$video', '$sound', '0', '', '', '')";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();