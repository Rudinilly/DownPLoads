<?php
require("../conexao.php");
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$data = $_POST['data'];

$sql = "UPDATE usuarios SET Nome_usu='$nome', Email_usu='$email', Senha_usu='$pass', Data_nasc='$data' WHERE Id_usu='$id'";
$query = mysqli_query($con, $sql);
if ($query) {
	echo "<script>alert('Usuário atualizado com sucesso!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php' />";
}else{
	echo "<script>alert('Erro!!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=../navbar.php' />";
}
?>