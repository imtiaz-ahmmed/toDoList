<?php
$servername = "localhost";
$dbname = "todo_list";
$data = json_decode(file_get_contents("php://input"), true);
$taskName = $data["taskName"];
$conn = new mysqli($servername, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO tasks (task_name) VALUES ('$taskName')";
if ($conn->query($sql) === TRUE) {
    $response = array("success" => true);
} else {
    $response = array("success" => false);
}

$conn->close();

echo json_encode($response);
?>
