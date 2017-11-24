<?php
require '../conexao.php';
session_start();
if (isset($_SESSION['usuario'])) {
	$logado = $_SESSION['usuario'];
}else{
	header('location:login.html');
}
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $date = date("d/m/Y");
    $sqlar = "SELECT * FROM arquivos WHERE Id_arq='".$id."'";
    $queryar = mysqli_query($con, $sqlar);  
    
    while($ar = mysqli_fetch_assoc($queryar)){
        $nd = $ar['N_Downloads'];        
    }
    
    $down =$nd+1;
    $sqlup = "UPDATE arquivos SET N_Downloads = '".$down."' WHERE Id_arq = '".$id."'";
    $queryup = mysqli_query($con, $sqlup); 
    
    $sqldow="INSERT INTO downloads (Email_usu, Nome_arq, Data_down) VALUES ('".$logado."', '".$nome."', '".$date."')";
    $querydow= mysqli_query($con, $sqldow);
    if($querydow){
    header("location:../arquivos/$nome");
    
    header("refresh:0, url=../tables.php");
    }else{
        echo '<script>alert(nfoi)</script>';
    }
    
    ?>      
    
    

