<?php
require('../conexao.php');
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

$id = $_GET['id'];

$sql = "SELECT * FROM arquivos WHERE Id_arq = $id";
$query = mysqli_query($con, $sql);
while ($a = mysqli_fetch_assoc($query)) {
	$nome  = $a['Nome_arq'];
	$cat  = $a['Categoria'];
	$clas  = $a['Clas_indicativa'];
}
$ext = strtolower(substr($nome, -4));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Editar Arquivo</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Atualizar</div>
      <div class="card-body">
          <form method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-8">
                <label for="exampleInputName">Nome do Arquivo</label>
                <input class="form-control"  type="text" value="<?php echo substr($nome, 0,-4);?>" name="nome">
              </div>
              <div class="col-md-8">
                <label for="exampleInputName">Categoria</label>
                <input class="form-control" type="text" value="<?php echo $cat?>" name="cat">
              </div>
              <div class="col-md-8">
                <label for="exampleInputName">Classificação indicativa</label>
                <input class="form-control" type="text" value="<?php echo $clas?>" name="clas">
              </div>

            </div>
          </div>
          <button class="btn btn-primary btn-block">Salvar</button>
        </form>       
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
<?php
error_reporting(0);
if($_POST['nome'] !=""|| $_POST['cat']!=""){
$nome =$_POST['nome'].$ext;
$cat = $_POST['cat'];
$clas=$_POST['clas'];

$sql="UPDATE arquivos SET Nome_arq = '$nome', Categoria = '$cat', Clas_indicativa = '$clas' WHERE Id_arq = '$id'" ;
$query = mysqli_query($con, $sql);
echo "<meta http-equiv='refresh' content='0 url=../cards.php'/>";
}
?>