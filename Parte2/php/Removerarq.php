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
<?php
require('../conexao.php');

$id=$_GET['id'];
$sql="DELETE FROM arquivos WHERE Id_arq='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
	echo "<script>alert('Arquivo Removido com Sucesso!!')</script>";
	echo "<meta http-equiv='refresh' content='0 url=../cards.php'/>";
}
?>