<?php
$user = strtolower($_POST['user']);
$pass = $_POST['pass'];

require '../conexao.php';

$sql = "SELECT * FROM usuarios WHERE  Email_usu ='$user' AND Senha_usu = '$pass'";
$query = mysqli_query($con, $sql);

if(mysqli_num_rows($query) > 0) {
	session_start();
	$_SESSION['usuario']=$user;
	$_SESSION['pass']=$pass;

	header('location:../index.php');
}
else{
    echo '<script>alert("Usuário ou senha incorretos!")</script>';
    echo "<meta http-equiv='refresh' content='0; url=../login.html' />";
}
?>

