<?php
include 'functions.php';

$list_name = $_POST['list_name'];

$list_name = escapeString($list_name);

$query = "INSERT INTO lists(list_name)VALUES('$list_name')";
$insert_list = mysqli_query($connection,$query);

if($insert_list){
    successMsg('List created!!');
}else{
    die("Query failed".mysqli_error($connection));
}

?>