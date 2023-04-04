<?php
include 'functions.php';

$task_name = $_POST['task_name'];
$list_id = $_POST['list_id'];

$task_name = escapeString($task_name);
$list_id = escapeString($list_id);

$query = "INSERT INTO tasks(task_name,list_id)VALUES('$task_name',$list_id)";
$task_name = mysqli_query($connection,$query);

if($task_name){
    successMsg('Task added!!');
}else{
    die("Query failed".mysqli_error($connection));
}

?>