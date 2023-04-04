<?php
include 'functions.php';

$task_id = $_POST['task_id'];
$task_id = escapeString($task_id);

$query = "DELETE FROM tasks WHERE task_id = $task_id";
$delete_query = mysqli_query($connection,$query);

checkQuery($delete_query);

successMsg("Task deleted!!");

?>