/*
*			Arquivo de chamada de funções JS
*		
*/

//; CHAMADA DE FUNÇÃO  AO CARREGAR A PÁGINA
$(document).ready(function() {
	console.log("AQUI");
		$.ajax({
		   url:'./minserver/response.php', // ARQUIVO PHP QUE TRATA A RESPOSTA
		   type:'POST', // método DE ENVIO
		   data: "POST_paramentro=getProductLoja", //seus paramêtros
		   dataType: "json", 
		   error: function(jqXHR, textStatus, errorThrown) {
				console.log('jqXHR: \n'+jqXHR);
				console.log('textStatus: \n'+textStatus);
				console.log('errorThrown: \n'+errorThrown);
		   },
		   success: function(data){ // sucesso de retorno executar função
		   
				alert(data);
				var htm = "";
				
				
				
				
				
				$("result-view").html();
		   
		   } // fim success
		}); // fim ajax
			
	
}); 