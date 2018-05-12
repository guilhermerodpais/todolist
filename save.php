<?php
include ('config.php');
$con=mysqli_connect("localhost","root","","todolist");
$id = $_POST["id"];
if(isset($_POST['text'])){ $text = $_POST['text'];}
$check = $_POST["check"];
if($text) {
$success_update = mysqli_query($con, "UPDATE task SET description='$text' WHERE id='$id' ") or die ("Error in query: $query. ".mysql_error());
}
if($check) {
$success_update = mysqli_query($con, "UPDATE task SET check_value='$check' WHERE id='$id' ") or die ("Error in query: $query. ".mysql_error());
echo $check;
}

 echo $success_update;
?>
