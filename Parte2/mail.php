<?php
	require 'vendor/autoload.php';
        require "conexao.php";
	if($_POST['Enviar']){
            $email = $_POST['email'];
            
            $sql = "SELECT * FROM usuarios WHERE Email_usu = '".$email."'";
            $query = mysqli_query($con, $sql);
            
            if($query){
            
            if(mysqli_num_rows($query) > 0){
            $dados =  mysqli_fetch_assoc($query);
                
            $from = new SendGrid\Email(null, "downploads@hotmail.com");
            $subject = "Recuperar Senha";
            $to = new SendGrid\Email(null,  $email);
            $content = new SendGrid\Content("text/html", "<html>
	<title>Solicitação de Senha</title>
        <meta charset='utf-8'>
    <body style='background-color:rgb(85,88,104);'>
	<center><img src='logo.png' width='100px'></center>
	<br>
	<div style='width:100%; height:15px; background:rgb(52,58,64);'></div>
	Olá, <br><br> ".$dados['Nome_usu']." você solicitou a sua senha ".$dados['Senha_usu'].","
        . "<br> caso não seja você o usuario ".$dados['Nome_usu']." desconsidere essa mensagem. <br><br><br> 
        Agradecimentos da equipe do DownPLoads por ter uma conta no nosso site e siga com os downloads :D.
	<br><br><br>
	<center>Copyright &copy; DownPLoads 2017</center>
    </body>
    </html>");
            $mail = new SendGrid\Mail($from, $subject, $to, $content);
            //Necessário inserir a chave
            $apiKey = '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';
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($mail);
             echo '<script>
             		alert("Mensagem Enviada!");
             		setTimeout(function(){
             			window.location = "php/login.php";
             		}, 10 );
              	</script>';
        }else{
                echo '
             	<script>
             		alert("Email não cadastrado ou incorreto!");
             		setTimeout(function(){
             			window.location = "forgot-password.html";
             		}, 500);
              	</script>';}
            }else{
                echo '
             	<script>
             		alert("Email não cadastrado ou incorreto!");
             		setTimeout(function(){
             			window.location = "forgot-password.html";
             		}, 500);
              	</script>';
            }
                
        }  

?>  