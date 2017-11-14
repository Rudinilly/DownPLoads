<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "Downpirateloads");
$con = mysqli_connect(HOST,USER,PASS) or die("Falha na conexão");
$banco = mysqli_select_db($con, DB);
?>
