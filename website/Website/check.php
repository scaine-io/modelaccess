<?php

$servername = "localhost";
$username = "script";
$password = "tomiscrazy";
$dbname = "scaine";
$status = 0;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT node, id, sound, complete, final FROM projects WHERE complete='$status'";
$result = $conn->query($sql);
 while($row = mysqli_fetch_array($result)){
    $error = 0;
    $node = $row["node"];
    $id = $row["id"];
    $sound = $row["sound"];
    $nodeCheck = $node . "/history";
    $reply = file_get_contents($nodeCheck);
    $array = json_decode($reply, true);
    $filename = $array[$id]['outputs'][30]['gifs'][0]['filename'];
    if (strlen($filename) > 5){
    $file_name = "/var/www/html/data/" . $filename;
    $url = $node . "/api/view?filename=" . $filename ;
    if (file_put_contents($file_name, file_get_contents($url)))
    {
        echo "File downloaded successfully";
    }
    else
    {
        $error = 1;

    }
    $url = $sound;
	echo $sound;
	$sound_file = $id . ".wav";	
    $file_name2 = "/var/www/html/data/" . $id . ".wav";
    if (file_put_contents($file_name2, file_get_contents($url)))
    {
        echo "File downloaded successfully";
    }
    else
    {
        $error = 1;

    }
    } 
	$complete = 1;
    if ($error != 1){
	$movieFile = $id.'.mp4';
	$soundFile = $id.'.wav';

	$file = 'path/to/file.txt';
if (file_exists($file_name)) {
   
if (file_exists($file_name2)) {

	$sql = "UPDATE projects SET complete='$complete', movieFile='$movieFile', soundFile='$soundFile' WHERE id='$id'";

	if ($conn->query($sql) === TRUE) {
	  echo "Record updated successfully";
	} else {
  	echo "Error updating record: " . $conn->error;
	}
	}
	$command = 'ffmpeg -y -i /var/www/html/data/'.$filename.' -filter:v "fps=fps=25" /var/www/html/data/'.$id.'.mp4';
	echo $command;
   shell_exec($command);
   
}
   
}

  }

$conn->close();



?>