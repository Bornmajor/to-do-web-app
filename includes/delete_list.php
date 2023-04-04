<?php
include 'functions.php';
$del_id = $_POST['del_id'];

$del_id = escapeString($del_id);
$query = "DELETE FROM lists WHERE list_id = $del_id";
$delete_query = mysqli_query($connection,$query);

checkQuery($delete_query);
successMsg('List deleted!!');
?>