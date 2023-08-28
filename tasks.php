<?php
$servername = "localhost";
$dbname = "todo_list";


$conn = new mysqli($servername,$dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, task_name, due_date FROM tasks ORDER BY due_date";
$result = $conn->query($sql);

$all_tasks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $all_tasks[] = $row;
    }
}

$conn->close();

echo json_encode($all_tasks);
?>
