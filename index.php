<?php
include ('config.php');
include ('header.php');
$con=mysqli_connect("localhost","root","","todolist");
$con2=mysqli_connect("localhost","root","","todolist");
if(isset($_GET['id_list'])){
if($_GET['id_list'] != null){
$_SESSION['list'] = $_GET['id_list'];
}
}
?>
<?php
if(isset($_GET['delete'])){ $delete = $_GET['delete'];}
if(isset($_GET['delete']) && $delete) {
$success = mysqli_query($con, "DELETE FROM task WHERE id='$delete'");
if($success) {
echo '<script type="text/javascript">alert("Tarefa Deletada");</script>';
$URL="index.php?id_list=".$_SESSION['list'];
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
$query = mysqli_query($con, "INSERT INTO task (list_id, check_value, description) VALUES ('$valorlista', 'false', '$values')");
}
}
mysqli_close($con);
}
?>
<div class="user-dashboard">
  <div class="row">
    <div id="todoBox" class="todoBox">
      <?php
      if(isset($_GET['id_list'])){
      echo '
      <div class="commentForm vert-offset-top-2">
        <div class="clearfix">';
          if (!isset($_POST['submit_val'])) {
          echo '<form method="post" action="">
            <div class="col-md-6 col-sm-6">
              <div id="container">
                <p id="add_field"><a href="#" class="btn-header outline"><span class="glyphicon glyphicon-plus"> </span> Add Tarefa </a></p>
              </div>
            </div>
            <div class="col-md-6 col-sm-6" style="  text-align: right;">
              <input class="btn btn-success" type="submit" name="submit_val" value="Salvar" />
            </div>
          </form>';
          } else {
          $URL="index.php?id_list=".$_SESSION['list'];
          echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
          echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
          }
          }
          ?>
        </div>
      </div>';
      ?>
      <div class="container">
        <?php
        if(!isset($_GET['id_list'])){
        echo '
        <div class="EmptyList">
          <h2>Favor Selecionar ou criar uma lista ao lado .</h2>
        </div>
        ';
        }
        else{
        echo '        <table style="width:100%">
          <tr>
            <th> Completa?  </th>
            <th> Descrição da Tarefa </th>
            <th> Ações </th>
          </tr>';
          $valorlista = $_GET['id_list'];
          $document_get = mysqli_query($con2, "SELECT * FROM task WHERE list_id='$valorlista' ORDER BY id DESC");
          while($match_value = mysqli_fetch_array($document_get)) {
          ?>
          <tr class="list-tasks">
            <td style="width: 20%;text-align:center;">
              <input id="id" type="hidden" />
              <input id="<?php echo $match_value['id']; ?>"  onchange="javascript:getcheck(this)" type="checkbox" <?php if($match_value['check_value'] == 'true') echo 'checked';  ?>/>
            </td>
            <td>
              <textarea id="<?php echo $match_value['id']; ?>" class="<?php echo $match_value['id']; ?>" onchange="javascript:getText(this)" <?php if($match_value['check_value'] == 'true') { echo 'disabled '; echo ' style="text-decoration:line-through"'; } ?> ><?php echo $match_value['description']; ?></textarea>
            </td>
            <td style="text-align:center;">
              <a class="btn btn-danger delete" href="?delete=<?php echo $match_value['id']; ?>"> <span class="glyphicon glyphicon-remove"></span> Delete </a>
            </td>
          </tr>
          <?php
          }
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
url: "save.php",
type: "post",
data: model,
success: function(data){
alert("Tarefa Atualizada!");
},
error:function(){
alert('Tarefa não atualizada, iremos conferir o problema.');
}
});
}
function getcheck(check){
  var id = check.id;
  var check = check.checked;
  if(check == true) {
  $("."+id).prop('disabled', true).attr('style','text-decoration:line-through');
  } else {
  $("."+id).prop('disabled', false).attr('style','text-decoration:none');
  }
  model = {
id: id,
      check: check
};
  $.ajax({
url: "save.php",
type: "post",
data: model,
success: function(data){
alert("Tarefa atualizada!");
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
