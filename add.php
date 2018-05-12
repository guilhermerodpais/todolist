<?php
include ('header.php');
$con=mysqli_connect("localhost","root","","todolist");
?>
<br/>
 <div style="float:right"> <a class="btn btn-warning" href="dashboard.php" > Dashboard </a>  <a class="btn btn-info" href="settings.php" > Settings </a>  <a class="btn btn-danger logout" href="logout.php" > Logout</a> </div>

<script type="text/javascript">
var counter = 0;
$(function(){
 $('p#add_field').click(function(){
 counter += 1;
 $('#container').append(
 '<strong>List No. ' + counter + '</strong><br />'
 + '<textarea id="field_' + counter + '" name="dynfields[]' + '"></textarea><br />' );

 });
});
</script>
	<?php
if (isset($_POST['submit_val'])) {
if ($_POST['dynfields']) {
foreach ( $_POST['dynfields'] as $key=>$value ) {
$values = mysqli_real_escape_string($con, $value);
$query = mysqli_query($con, "INSERT INTO list (description) VALUES ('$values')");
}
}
 mysqli_close($con);
}
?>
<?php if (!isset($_POST['submit_val'])) { ?>
 <form method="post" action="">
 <div id="container">
 <p id="add_field"><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-plus"> </span> Add List </a></p>
 <hr/>
 </div>
<br/>
 <input class="btn btn-success" type="submit" name="submit_val" value="Save" />
 </form>
<?php } else { ?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success! </strong> Your lists has been successfully added, please go to your <a href="dashboard.php" > dashboard board </a>.
</div>
<?php
}
?>
<?php include ('footer.php'); ?>
