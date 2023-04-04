<?php
include 'functions.php';

$task_id = $_POST['task_id'];
// $checked = $_POST['checked'];
// $uncheck = $_POST['uncheck'];

$task_id = escapeString($task_id);

if(isset($_POST['checked'])){

 $query = "UPDATE tasks SET status = 'completed' WHERE task_id = $task_id";
$update_query = mysqli_query($connection,$query);

checkQuery($update_query);

successMsg('Task status completed!!');   
}

if(isset($_POST['uncheck'])){
    $query = "UPDATE tasks SET status = 'pending' WHERE task_id = $task_id";
    $update_query = mysqli_query($connection,$query);
    
    checkQuery($update_query);  
    successMsg('Task status pending!!');
}



?>