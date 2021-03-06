<?php
require 'conexao.php';
session_start();
if (isset($_SESSION['usuario'])) {
	$logado = $_SESSION['usuario'];
        //Inicializar variáveis
        $p=0;        
        $uploads=0;
        $downloads=0;
        //sqls
        $sql = "SELECT * FROM usuarios";
        $sqlarq = "SELECT * FROM arquivos";    
        $sqlup = "SELECT * FROM uploads";  
        $sqldow = "SELECT * FROM downloads";
        //querys
        $query = mysqli_query($con, $sql);
        $queryarq= mysqli_query($con, $sqlarq);
        $queryup= mysqli_query($con, $sqlup);
        $querydow= mysqli_query($con, $sqldow);
        
        //dados do usuario
        while ($u = mysqli_fetch_assoc($query)){
           $user = $u['Email_usu'];          
            //downloads permitidos
            if($user == $logado){
            $data  = $u['Data_nasc'];
            $Id_usu = $u['Id_usu'];
            $permite = $u['Idade_usu'];
            $name = $u['Nome_usu'];            
            $senha = $u['Senha_usu'];    
            while ($a = mysqli_fetch_assoc($queryarq)){
                if($a['Clas_indicativa']<=$permite){
                   $p++;             
                }
            }
         //uploads feitos
            while ($up = mysqli_fetch_assoc($queryup)){   
                if($Id_usu == $up['Id_usu']){
                   $uploads++;   
                 }         
            }
            //downloads feitos
            while($d = mysqli_fetch_assoc($querydow)){
                if($logado == $d['Email_usu']){
                    $downloads++;
                }
            }
            }
        }
       
        
        //atualizar idade                     
         list($dia, $mes, $ano) = explode('/', $data);
 
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
 
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        $sql = "UPDATE usuarios SET Idade_usu ='$idade' WHERE Id_usu='$Id_usu'";
        $query = mysqli_query($con, $sql);
        
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
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dowpirateloads</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
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
              <a href="navbar.php">Conta</a>
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
     
        </li>
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
            <a href="#">Meu Perfil</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $logado;?></li>
      </ol>
       <div class="row">
        <div class="col-xl-4 col-sm-12 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-download"></i>
              </div>
              <div class="mr-5"><?php echo $p;?> Arquivo(s) Disponível(is)</div>
            </div>              
          </div>
        </div>
           
        <div class="col-xl-4 col-sm-12 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-arrow-up"></i>
              </div>
              <div class="mr-5"><?php echo $uploads;?> Upload(s) Feito(s)</div>
            </div>
          </div>
        </div>
           
        <div class="col-xl-4 col-sm-12 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><?php echo $downloads;?> Download(s) Feito(s)</div>
            </div>             
          </div>
        </div>
           <div class="container-fluid">
               <label>Nome Completo </label>
               <input value="<?php echo $name; ?>" type="text"class="form-control col-md-5" disabled></input>
               <label>Email </label>
               <input value="<?php echo $logado;?>" type="text"class="form-control col-md-5" disabled></input>
                 <label>Senha </label>
                 <input id="senha" value="<?php echo $senha;?>" type="password"class="form-control col-md-2" disabled></input>
                 <input id="chek" onclick="if(document.getElementById('chek').checked){document.getElementById('senha').type = 'text';}else{ document.getElementById('senha').type = 'password';}" type="checkbox">Mostrar Senha</input><br>
               <label>Idade</label>
               <input value="<?php echo $idade;?>" type="text"class="form-control col-md-1" disabled></input>
               <label>Data De Nascimento </label>
               <input value="<?php echo $data;?>" type="text"class="form-control col-md-2" disabled></input>
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
            <a class="btn btn-primary" href="?sair=sair">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script>
    if(document.getElementById('chek').checked){
        document.getElementById('senha').type = 'password';
    }
    </script>
  </div>
</body>

</html>


