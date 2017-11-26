<?php
require("../conexao.php");
$id = $_POST['id'];
$sql = "DELETE FROM usuarios WHERE Id_usu='$id'";
$query = mysqli_query($con, $sql);
if ($query) {
	echo "<script>alert('Usuário removido com sucesso')</script>";
	unset($_SESSION);
	echo "<meta http-equiv='refresh' content='0; url=../login.html'/>";

}else{
	echo "<script>alert('Houve um erro')</script>";
}
?>