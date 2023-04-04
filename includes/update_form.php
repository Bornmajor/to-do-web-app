<?php
include 'functions.php';

$list_name = $_POST['list_name'];
$list_id = $_POST['list_id'];

$list_name = escapeString($list_name);
$list_id = escapeString($list_id);

$query = "UPDATE lists SET list_name = '$list_name' WHERE list_id = $list_id";
$update_query = mysqli_query($connection,$query);

checkQuery($update_query);

successMsg("List updated");


?>