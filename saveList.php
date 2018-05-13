<?php
include ('config.php');
$con=mysqli_connect("localhost","root","","todolist");
$id = $_POST["id"];
if(isset($_POST['text'])){ $text = $_POST['text'];}
if($text) {
$success_update = mysqli_query($con, "UPDATE list SET description='$text' WHERE id='$id' ") or die ("Error in query: $query. ".mysql_error());
}

 echo $success_update;
?>
