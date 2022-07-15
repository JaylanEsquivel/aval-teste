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