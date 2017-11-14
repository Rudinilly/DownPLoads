<?php
require '../conexao.php';

$nome = $_POST['nome'];
$data = $_POST['data'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirm = $_POST['confirm'];

$sql = "SELECT *FROM usuarios";
$query = mysqli_query($con, $sql);

   list($dia, $mes, $ano) = explode('/', $data);
   
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
  
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    
    while ($a = mysqli_fetch_assoc($query)){
        $user = $a['Email_usu'];
        if($user == $email){
            $senha = 0;
            $confirm=1;
        
    }
    }
if($senha  == $confirm){    
    $sql = "INSERT INTO usuarios (Nome_usu, Email_usu, Senha_usu, Idade_usu, Data_nasc) VALUES ('".$nome."', '".$email."', '".$senha."', '".$idade."', '".$data."')";
    $query = mysqli_query($con,$sql);

     echo "<meta http-equiv='refresh' content='0; url=../register.html' />";
}else{
    echo '<script>alert("Erro: Ou o email já está cadastrado ou a senha está errada")</script>';
    echo "<meta http-equiv='refresh' content='0; url=../register.html' />";
}
?>
