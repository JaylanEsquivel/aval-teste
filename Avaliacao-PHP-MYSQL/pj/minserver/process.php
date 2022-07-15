<?php 


function get_product($post){
	$Conexao    = Conexao::getConnection();
		$where = "WHERE";
	
	// FILTROS DA CONSULTAS
		if(!empty($post['search'])){
			$search = $post['search'];
			
			$where .= " P.nome LIKE '%$search%' AND";
		}
		
		if(!empty($post['cor'])){
			$cor    = $post['cor'];
			
			$where .= " P.cor = '$cor' AND";
		}
		
		if(!empty($post['preco'])){
			$preco       = $post['preco'];
			$verificador = $post['tipo'];
			
			if(strlen($preco) >= 8){
				$preco_ = str_replace(".","", $preco);
				$preco_fim = str_replace(",",".", $preco_);
			}else{
				$preco_fim = str_replace(",",".", $preco);
			}
			
			
			
			switch ($verificador) {
				case "1":
						$where .= " V.preco > '$preco_fim' AND";
					break;
				case "2":
						$where .= " V.preco < '$preco_fim' AND";
					break;	
				case "3":
						$where .= " V.preco = '$preco_fim' AND";
					break;
				default:
					$where .= "";
			}
		}
	// FILTROS DA CONSULTAS
	
		$where .= " 1=1";
	
		$sql = "SELECT P.idprod,P.nome,P.cor,V.preco FROM `produtos` P LEFT JOIN precos V ON P.idprod=V.idprod $where";
		$query      = $Conexao->query($sql);
	
	$produtos   = $query->fetchAll(\PDO::FETCH_ASSOC);
	
	return $produtos;
}
	// consulta de cores 
function get_cores(){
	$Conexao    = Conexao::getConnection();
	
	$sql = "SELECT DISTINCT cor FROM `produtos`";
	$query   = $Conexao->query($sql);
	$cores   = $query->fetchAll(\PDO::FETCH_ASSOC);
	
	return $cores;
	
}

function get_cor_produto($id){ // consulta cor de produto especifico
	
	$Conexao    = Conexao::getConnection();
	$query      = $Conexao->query("SELECT cor FROM `produtos` WHERE idprod = $id");
	$cor        = $query->fetchColumn();

	return $cor;

}


function execute_resp($post){
	$db    = Conexao::getConnection();
	
		$produto   = $post['produto'];
		$preco     = $post['preco'];
		$cor       = strtoupper($post['cor']);
	
		if($post['POST_paramentro'] == 'setProduct'){
			
			$response = setProduct($produto,$preco,$cor,$db);
			
		}else if($post['POST_paramentro'] == 'upProduct'){
			$id        = $post['id'];
			$response = upProduct($produto,$preco,$id,$db);
			
		}else{
			$id        = $post['id'];
			$response = delProduct($id,$db);
		}

	
	return $response;
	
}

function setProduct($produto,$preco,$cor,$db){	
	
	$query      = $db->query("INSERT INTO `produtos`(`nome`, `cor`) VALUES ('$produto','$cor')");
	$idprod     = $db->lastInsertId();
	
	// caso 0 desconto for aplicado na inserção esaa linha abaixo sera descomentada com sua funçao
	//$valor      = desconto(formatpreco($preco),$cor); // AQUI EU FORMATO O VALOR E APLICO O DESCONTO
	$valor      = formatpreco($preco); // AQUI EU FORMATO O VALOR E APLICO O DESCONTO
	$query2     = $db->query("INSERT INTO `precos`(`idprod`, `preco`) VALUES ('$idprod','$valor')");
		
	return $query;
}

function upProduct($produto,$preco,$id,$db){	
	
	$query      = $db->query("UPDATE `produtos` SET `nome`='$produto' WHERE `idprod`= $id");
	
	$cor        = get_cor_produto($id);
	//$valor      = desconto(formatpreco($preco),$cor); // AQUI EU FORMATO O VALOR E APLICO O DESCONTO
	$valor      = formatpreco($preco); // AQUI EU FORMATO O VALOR E APLICO O DESCONTO
	
	$query2     = $db->query("UPDATE `precos` SET `preco`='$valor' WHERE `idprod` = $id");
	
	return $query;
}

function delProduct($id,$db){
	
	$sql = "DELETE FROM `produtos` WHERE idprod = $id";
	$query   = $db->query($sql);
	
	return $query;
	
}

function formatpreco($preco){
	
	if(strlen($preco) >= 8){
		$preco_ = str_replace(".","", $preco);
		$preco_fim = str_replace(",",".", $preco_);
	}else{
		$preco_fim = str_replace(",",".", $preco);
	}
	
	return $preco_fim;
	
}
/*  CASO DESCONTO SEJA APLICADO NO CADASTRO ESA FUNÇÃO SERÁ ATIVADA
function desconto($valor,$cor){ // FUNÇÃO DE CALCULAR O DESCONTO
	
	switch ($cor) {
		case "AZUL":
		
				$percentual = 20;
				$desconto = ($percentual*$valor)/100;
				$valorcomdesconto = $valor - $desconto;
				
			break;
		case "VERMELHO":
		
			if($valor > 50){
				$percentual = 5;
				$desconto = ($percentual*$valor)/100;
				$valorcomdesconto = $valor - $desconto;
			}else{
				$percentual = 20;
				$desconto = ($percentual*$valor)/100;
				$valorcomdesconto = $valor - $desconto;
			}
				
				
			break;	
		case "AMARELO":
		
				$percentual = 10;
				$desconto = ($percentual*$valor)/100;
				$valorcomdesconto = $valor - $desconto;
				
			break;
		default:
			$valorcomdesconto = $valor;
	}
	
	return $valorcomdesconto;
}*/