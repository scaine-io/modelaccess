<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$video = $_GET['id'];

$servername = "localhost";
$username = "script";
$password = "tomiscrazy";
$dbname = "scaine";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM projects WHERE id='$video'";
$result = $conn->query($sql);
 while($row = mysqli_fetch_array($result)){
    $array['node'] = $row["node"];
    $array['id'] = $row["id"];
    $array['sound'] = $row["sound"];
    $array['complete'] = $row["complete"];
    $array['movieFile'] = $row["movieFile"];
    $array['soundFile'] = $row["soundFile"];
    $array['final'] = $row["final"];
  }
$conn->close();

echo json_encode($array);

?>