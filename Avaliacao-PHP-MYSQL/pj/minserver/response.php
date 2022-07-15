<?php 
	session_start();

	require_once "define.php";  // DEFINE OS DADOS DE CONEXAO
	require_once "Conexao.php"; // CONEXAO AO DB
	require_once "process.php"; // CONSULTAS AO DB

	if(isset($_POST['POST_paramentro'])){
				
		switch ($_POST['POST_paramentro']) {
		  case "getProductLoja":
		  
				$response = get_product($_POST);
			
			break;
		  case "getCores":
				$response = get_cores();
			break;
		  case "setProduct":
		  
				$response = execute_resp($_POST);
			
			break;
		  case "upProduct":
		  
				$response = execute_resp($_POST);
			
			break;
		  case "delProduct":
		  
				$response = execute_resp($_POST);
			
			break;
		  default:
			$response = "Parametro informado está inválido!";
		}		
			
	}else{
		$response = "Parametro não informado";  // retorno caso o parametro não sea passado
	}
	
	echo json_encode($response); 