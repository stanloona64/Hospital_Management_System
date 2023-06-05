<?php

session_start();


if(isset($_SESSION['admin']))
{
	//çıkış
	unset($_SESSION['admin']);
	//indexe yönlendirme
	header("Location:../index.php");
}




?>