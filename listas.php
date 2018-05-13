<?php
include ('config.php');
include ('header.php');
$con=mysqli_connect("localhost","root","","todolist");
$con2=mysqli_connect("localhost","root","","todolist");
?>
<?php
if(isset($_GET['delete'])){ $delete = $_GET['delete'];}
if(isset($_GET['delete']) && $delete) {
$success = mysqli_query($con, "DELETE FROM list WHERE id='$delete'");
if($success) {
echo '<script type="text/javascript">alert("Tarefa Deletada");</script>';
$URL="listas.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
}
?>
<?php
if (isset($_POST['submit_val'])) {
if ($_POST['dynfields']) {
foreach ( $_POST['dynfields'] as $key=>$value ) {
$values = mysqli_real_escape_string($con, $value);
$valorlista = $_GET['id_list'];
$query = mysqli_query($con, "INSERT INTO list (description) VALUES ('$values')");
}
}
mysqli_close($con);
}
?>
<div class="user-dashboard">
  <div class="row">
    <div id="todoBox" class="todoBox">
      <div class="commentForm vert-offset-top-2">
        <div class="clearfix">';
          <?php if (!isset($_POST['submit_val'])) { ?>
          <form method="post" action="">
            <div class="col-md-6 col-sm-6">
              <div id="container">
                <p id="add_field"><a href="#" class="btn-header outline"><span class="glyphicon glyphicon-plus"> </span> Add Lista </a></p>
              </div>
            </div>
            <div class="col-md-6 col-sm-6" style="  text-align: right;">
              <input class="btn btn-success" type="submit" name="submit_val" value="Salvar" />
            </div>
          </form>
          <?php } else {
          $URL="listas.php";
          echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
          echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
          ?>
        </div>
      </div>
      <div class="container">
        <table style="width:100%">
          <tr>
            <th> Descrição da Tarefa </th>
            <th> Ações </th>
          </tr>
          <?php
          $document_get = mysqli_query($con2, "SELECT * FROM list ORDER BY id DESC");
          while($match_value = mysqli_fetch_array($document_get)) {
          ?>
          <tr class="list-tasks">
            <td>
              <textarea id="<?php echo $match_value['id']; ?>" class="<?php echo $match_value['id']; ?>" onchange="javascript:getText(this)"><?php echo $match_value['description']; ?></textarea>
            </td>
            <td style="text-align:center;">
              <a class="btn btn-info" href="index.php?id_list=<?php echo $match_value['id']; ?>"> <span class=""></span> Ver </a>
              <a class="btn btn-danger delete" href="?delete=<?php echo $match_value['id']; ?>"> <span class="glyphicon glyphicon-remove"></span> Deletar </a>
            </td>
          </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
function getText(text){
  var id = text.id;
  var text = text.value;
  model = {
id: id,
      text: text
};
  $.ajax({
url: "saveList.php",
type: "post",
data: model,
success: function(data){
alert("Tarefa Atualizada!");
location.reload();
},
error:function(){
alert('Tarefa não atualizada, iremos conferir o problema.');
}
});
}
</script>
<script type="text/javascript">
var counter = 0;
$(function(){
$('p#add_field').click(function(){
counter += 1;
$('#container').append(
'<textarea id="field_' + counter + '" name="dynfields[]' + '" class="form-control add-task"></textarea><br />' );
});
});
</script>
<script>
$('.delete').click(function(){
return confirm("Are you sure you want to Delete it?");
});
</script>
<?php include ('footer.php'); ?>
