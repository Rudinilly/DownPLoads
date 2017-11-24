<?php
require '../conexao.php';
session_start();
if (isset($_SESSION['usuario'])) {
	$logado = $_SESSION['usuario'];
}else{
	
}

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);

while($u = mysqli_fetch_assoc($query)){
    if ($u['Email_usu'] == $logado){
        $id = $u['Id_usu'];
    }
}

$nome=$_POST['nome'];
$class=$_POST['class'];
$cat=$_POST['cat'];

date_default_timezone_set("America/Fortaleza");
$hora = date("H:i");
$data = date("d")."/".date("m")."/".date("Y");

$dir = '../arquivos/';
$ext = strtolower(substr($_FILES['file']['name'], -4));
$nome = $nome.$ext;
$tam = $_FILES['file']['size'];
$tam = ceil($tam / 1024);

if($tam >1024){
    $tam = ceil($tam/1024)."Mb";  
}else{
    $tam = ceil($tam)."Kb";
}
$n = 0;

if ($ext == '.rar' || $ext == '.zip') {
	if (move_uploaded_file($_FILES['file']['tmp_name'], $dir.$nome)) {		
            
            $sql = "INSERT INTO arquivos (Nome_arq, Tamanho_arq, N_Downloads, Id_usu, Clas_indicativa, Categoria) VALUES ('".$nome."', '".$tam."', '".$n."' , '".$id."' , '".$class."' , '".$cat."')";
            $query = mysqli_query($con, $sql);
            
             if ($query) {
                        echo "<script>alert('Arquivo Cadastrado com Sucesso')</script>";                        
                        $sql = "INSERT INTO uploads (Id_usu, Nome_arq, Hora_up, Data_up) VALUES ('".$id."', '".$nome."', '".$hora."' , '".$data."' )";
                        $query = mysqli_query($con, $sql);    
                         echo "<meta http-equiv='refresh' content='0; url=../charts.php' />";
                    
                }else{
                    echo "<script>alert('Erro ao cadastrar arquivo!')</script>";
                    echo "<meta http-equiv='refresh' content='0; url=../charts.php' />";
                    }
          
	}else{
            echo "<script>alert('Erro ao cadastrar')</script>";
            echo "<meta http-equiv='refresh' content='0; url=../charts.php' />";
	}

}else{
echo "<script>alert('Aceitamos apenas os formatos: zip, rar')</script>";
echo "<meta http-equiv='refresh' content='0; url=../charts.php' />";
}
?>