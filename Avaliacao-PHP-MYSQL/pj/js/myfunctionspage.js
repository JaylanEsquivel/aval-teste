/*
*			Arquivo de chamada de funções JS
*		
*/

//; CHAMADA DE FUNÇÃO  AO CARREGAR A PÁGINA

$(document).ready(function() {	
	var param = "POST_paramentro=getProductLoja";
	
	getcores(); // monta o select do filto de cores
	getproduct(param);	
}); 

// AÇÕES DE FILTROS
$('#search').keyup(function() { // CONSULTA POR NOME
	  if ($('#search').val) {
		  
		var search  = $('#search').val();
		
		var param = "POST_paramentro=getProductLoja&search="+search;
		getproduct(param);
		
	  }
});

$('#corf').change(function() { // CONSULTA POR COR
	  if ($('#corf').val) {
		  
		var cor  = $('#corf').val();
		
		var param = "POST_paramentro=getProductLoja&cor="+cor;
		getproduct(param);
		
	  }
});

$('#tipo').change(function() { // CONSULTA POR PREÇO
	  if ($('#precof').val) {
		  
		var preco  = $('#precof').val();
		var tipo   = $('#tipo').val();
		
		var param = "POST_paramentro=getProductLoja&preco="+preco+"&tipo="+tipo;
		getproduct(param);
		
	  }
});

// AÇÕES DE FILTROS
// FUNÇÕES DOS BOTÕES

$('#btn-inserir').click(function() { // CONSULTA POR PREÇO
	//alert("insert");  
	// DADOS DO FORMULARIO
	var produto = $('#produto').val();
	var preco   = $('#preco').val();
	var cor     = $('#cor').val();
	// DADOS DO FORMULARIO
	
	var param = "POST_paramentro=setProduct&preco="+preco+"&produto="+produto+"&cor="+cor;
		upproduct(param);			
});
$('#btn-update').click(function() { // CONSULTA POR PREÇO
	//alert("update");  
	var idhidden     = $('#idhidden').val();
	if(idhidden){
		// DADOS DO FORMULARIO
		var produto = $('#produto').val();
		var preco   = $('#preco').val();
		var cor     = $('#cor').val();
		// DADOS DO FORMULARIO
		
		var param = "POST_paramentro=upProduct&preco="+preco+"&produto="+produto+"&cor="+cor+"&id="+idhidden;
			upproduct(param);	
	}else{
			alert("Para esa ação é necessário selecionar o item na tabela abaixo primeiro.");
	}
});
$('#btn-delete').click(function() { // CONSULTA POR PREÇO
		//alert("delete");  
		var idhidden     = $('#idhidden').val();
		if(idhidden){
			if (confirm("Tem certeza que deseja apagar esse produto ?") == true) {
				// DADOS DO FORMULARIO
				var produto = $('#produto').val();
				var preco   = $('#preco').val();
				var cor     = $('#cor').val();
				var idhidden     = $('#idhidden').val();
				// DADOS DO FORMULARIO
				
				var param = "POST_paramentro=delProduct&preco="+preco+"&produto="+produto+"&cor="+cor+"&id="+idhidden;
				
					upproduct(param);	
					
					
			}
		}else{
			alert("Para esa ação é necessário selecionar o item na tabela abaixo primeiro.");
		}
});
// FUNÇÕES DOS BOTÕES




// FUNÇÕES
function getproduct(param){
	
	$.ajax({
		   url:'./minserver/response.php', // ARQUIVO PHP QUE TRATA A RESPOSTA
		   type:'POST', // método DE ENVIO
		   data: param, //seus paramêtros
		   dataType: "json", 
		   error: function(jqXHR, textStatus, errorThrown) {
				console.log('jqXHR: \n'+jqXHR);
				console.log('textStatus: \n'+textStatus);
				console.log('errorThrown: \n'+errorThrown);
		   },
		   success: function(data){ // sucesso de retorno executar função
		   
				var retorno = JSON.parse(JSON.stringify(data));
				
				var htm = "";
				
				if(retorno){
					
					$.each(retorno, function( p, row ){
						var valor = row.preco;
						var valorFormatado = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
							
						htm += "		<tr>";
						htm += "		  <td>"+row.nome+"</td>";
						htm += "		  <td>"+valorFormatado+"</td>";
						htm += "		  <td>"+row.cor+"</td>";
						htm += "		  <td><button type='button' onclick=\"subirdados('"+row.nome+"','"+row.cor+"','"+row.preco+"','"+row.idprod+"');\">selecionar</button></td>";
						htm += "		</tr>";
						
					});	
				
				}else{
						htm += "		<tr>";
						htm += "		  <td colspan='4'>SEM REGISTROS</td>";
						htm += "		</tr>";
				}

				$("#result-view").html(htm);
		   } // fim success
		}); // fim ajax
}

function getcores(){
	
	$.ajax({
		   url:'./minserver/response.php', // ARQUIVO PHP QUE TRATA A RESPOSTA
		   type:'POST', // método DE ENVIO
		   data: "POST_paramentro=getCores", //seus paramêtros
		   dataType: "json", 
		   error: function(jqXHR, textStatus, errorThrown) {
				console.log('jqXHR: \n'+jqXHR);
				console.log('textStatus: \n'+textStatus);
				console.log('errorThrown: \n'+errorThrown);
		   },
		   success: function(data){ // sucesso de retorno executar função
		   
				var retorno = JSON.parse(JSON.stringify(data));
				
				var htm = "";
				
				if(retorno){
						htm += "<option value='' selected>Todos</option>";
					$.each(retorno, function( p, row ){
							
						htm += "<option value='"+row.cor+"'>"+row.cor+"</option>";
						
					});	
				}else{
						htm += "<option value='' disabled selected>Todos</option>";
				}

				$("#corf").append(htm);
		   } // fim success
		}); // fim ajax
}

function subirdados(nome,cor,preco,id){
	
		$('#produto').val(nome);
		$('#cor').val(cor);
		$('#preco').val(preco);
		$('#idhidden').val(id);
	
}

// FUNÇÃO DE CHAMADA DE AÇÕES DO DB
function upproduct(param){
	
		$.ajax({
		   url:'./minserver/response.php', // ARQUIVO PHP QUE TRATA A RESPOSTA
		   type:'POST', // método DE ENVIO
		   data: param, //seus paramêtros
		   dataType: "json", 
		   error: function(jqXHR, textStatus, errorThrown) {
				console.log('jqXHR: \n'+jqXHR);
				console.log('textStatus: \n'+textStatus);
				console.log('errorThrown: \n'+errorThrown);
		   },
		   success: function(data){ // sucesso de retorno executar função
				var retorno = JSON.parse(JSON.stringify(data));
				if(retorno){
					alert("Ação executada com Sucesso!;");
					window.location.reload();
				}else{
					alert("Falha ao executar ação!;");
				}
		   } // fim success
		}); //
	
	
	
}
