<?php
include ('config.php');
$conList=mysqli_connect("localhost","root","","todolist");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>To-Do List | Guilherme Pais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Guilherme Pais">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='js/index.js'></script>
    <style type="text/css">
      .success_msg {
        position:absolute;
        right:10px;
        top:10px;
        padding:10px;
        background:black;
        opacity:0.7;
        color:#fff;
      }
      textarea {
    width:95%;
      }
      fieldset {
        width: 100%;
      }
    </style>
  </head>
  <body class="home">
    <div class="success_msg" style="display:none"> Salvo com sucesso! </div>
    <div class="container-fluid display-table no-padding">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-2 hidden-xs display-table-cell v-align box" id="navigation">
          <div class="welcome">
            <div class="avatar">
              <img src="https://i.imgur.com/p9fj5Wn.png" alt="Avatar">
            </div>
            <div class="welcome-text">
              <span>Olá,</span>
              <br>
              <span class="username">Seja bem-vindo!</span>
            </div>
          </div>
          <div class="navi">
            <ul>
              <li><a href="listas.php" class="btn-nav" name="add-list" data-target="#add_list">Gerenciar Listas</a></li>
              <?php
              $document_get = mysqli_query($conList, "SELECT * FROM list ORDER BY id DESC");
              while($match_value = mysqli_fetch_array($document_get)) {
              ?>
              <li><a href="index.php?id_list=<?php echo $match_value['id']; ?>"><span><?php echo $match_value['description']; ?></span></a></li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="col-md-10 col-sm-10 display-table-cell v-align">
          <div class="row hidden-md hidden-lg hidden-sm">
            <header>
              <div class="col-md-7">
                <nav class="navbar-default pull-left">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                  </div>
                </nav>
              </header>
            </div>
            <script>
            $(".navi a").each(function() {
            if (this.href == window.location.href) {
            $(this).addClass("active-sidebar-link");
            }
            });
            </script>
