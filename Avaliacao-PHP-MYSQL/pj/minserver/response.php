<?php 
	session_start();

	require_once "define.php";  // DEFINE OS DADOS DE CONEXAO
	require_once "Conexao.php"; // CONEXAO AO DB
	require_once "process.php"; // CONSULTAS AO DB

	if(isset($_POST['POST_paramentro'])){
		

		$response = "Parametro informado";
		
		
			
			
	}else{
		$response = "Parametro não informado";  // retorno caso o parametro não sea passado
	}
	
	
	
	
	echo json_encode($response); 