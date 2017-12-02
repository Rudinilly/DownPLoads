<?php
session_start();
if (isset($_SESSION['usuario'])) {
	$logado = $_SESSION['usuario'];
}else{
	header('location:login.html');
}
if (isset($_GET['sair'])) {
	unset($_SESSION['usuario']);
	header("location:login.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gerenciar Conta</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><font style="margin-left:40px;font-family: Arial;color: #ccc; ">DownPLoads</font></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Meu Perfil</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-arrow-up"></i>
            <span class="nav-link-text">Upload</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw  fa-download"></i>
            <span class="nav-link-text">Download</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gears"></i>
            <span class="nav-link-text">Gerenciar</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.php"> 
                conta
                
              </a>
            </li>
            <li>
              <a href="cards.php">Arquivos</a>
            </li>
          </ul>
        </li>
   
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Menu Levels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
       
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Gerenciar</a>
        </li>
        <li class="breadcrumb-item active">Conta</li>
      </ol>
      <h1>Minha Conta</h1>
      <hr>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <?php
require 'conexao.php';
    $us = $_SESSION['usuario'];
    $sql = "SELECT * FROM usuarios WHERE Email_usu  ='".$us."'";
    $query = mysqli_query($con, $sql);


    while($dados = mysqli_fetch_assoc($query)){
      $id = $dados['Id_usu'];
      $nome = $dados['Nome_usu'];
      $senha = $dados['Senha_usu'];
      $email = $dados['Email_usu'];
      $data_nasc = $dados['Data_nasc'];
      $idade = $dados['Idade_usu'];
    } 
           ?>
           <form method="post" action="php/atualiza_usu.php">
           <div class="form-group col-md-5">
            <label>Nome</label>
            <input type="hidden" value="<?php echo $id?>" name='id'>
            <input class="form-control" type="text" value="<?php echo $nome;?>" name="nome" required>
          </div>
           <div class="form-group col-md-5">
            <label>Email</label>
            <input class="form-control" type="text" value="<?php echo $email;?>" name="email" required>
          </div>
           <div class="form-group col-md-3">
            <label>Senha</label>
            <input class="form-control" type="password" value="<?php echo $senha;?>" name='pass' required>
          </div>
           <div class="form-group col-md-2">
            <label>Data Nascimento</label>
            <input class="form-control" type="text" value="<?php echo $data_nasc;?>" name='data' required>
          </div>
           <div class="form-group col-md-1">
            <label>Idade</label>
            <input class="form-control" type="text" value="<?php echo $idade;?>" disabled name='idade' required>
          </div>          
          <div class="col-md-2">   
              <input type="hidden" value="<?php echo $id?>" name='id'>
              <input type="submit" value="Atualizar" class="btn btn-success btn-block">
          </div>
          </form>
          <form action="php/excluir_usu.php" method="post">
            <input type="hidden" value="<?php echo $id?>" name='id'>
            <div class="col-md-2" >
             <input type="submit" value="Excluir" class="btn btn-danger btn-block">
            </div>
          </form>          
          </div>
        </div>
      </div>
     
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © DownPLoads 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pronto pra sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Logout" abaixo se você estiver pronto para terminar sua sessão atual</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- Toggle between fixed and static navbar-->
       <!-- Toggle between dark and light navbar-->
   
  </div>
</body>

</html>
