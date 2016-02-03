$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
    	console.log(a);
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$.ajaxSetup ({
	// Disable caching of AJAX responses
	cache: false
});

$(document).on('change', '.autoupdate-input', function(){
    //alert( this.value ); // or $(this).val()
	  var attrId = $(this).closest("form").attr("id");
	  var tabela = attrId.split('-')[0];
	  var id = attrId.split('-')[1];
	  var col = $(this).attr("name");
	  var val = $(this).val();
	  //console.log(tabela+" "+id+" "+col+" "+val);

	  if (tabela!=null && id != null && col!=null && val != null)
	  {
	  	$.post("http://localhost/sigprog/index.php/admin/update",
	  	{
	  		'tabela' : tabela,
	  		'id' : id,
	  		'col' : col,
	  		'val' : val
	  	}, function (response)
	  	{
	  		//console.log(response);
	  		//alert("Atualização realizada com sucesso!");
	  	});
	  }
});

$(document).on('submit', '.add-input', function(){
		event.preventDefault();
		var form = $(this).find(':input');
		var table = $(this).attr("name");
		var formArray = form.serializeArray();
		var jsonArray = JSON.stringify(formArray);
		//console.log(table);

		
		$.post("http://localhost/sigprog/index.php/"+table+"/add", {
			'jsonArray' : jsonArray
		}, function ( response )
		{
			if (response)
			{
				console.log(response);
				listItens = $("#listItens");
				$.get("http://localhost/sigprog/index.php/"+table+"/generateForm/"+response, {

				},function (response2) {
					//console.log(response2);
					$("#listItens").append(response2);
					$('select').material_select();
					$('input#input_text, textarea#textarea1').characterCounter();
				});
				//$("#listItens").find(":last").clone().appendTo("#listItens");
				//$("#listItens").append(alert);
				//console.log(alert);
			}
		});
		
	});

$(document).on("click", ".delete-button", function (event)
	{
		event.preventDefault();
		var attrId = $(this).closest("form").attr("id");
	  	var tabela = attrId.split('-')[0];
	  	var id = attrId.split('-')[1];
	  	var me = $(this);
		$.post("http://localhost/sigprog/index.php/"+tabela+"/delete", {
			'id' : id
		}, function (response){
			if (response)
			{
				//alert(response);
				//alert("Removido com sucesso!");
				console.log(me.closest("form"));
				me.closest("form").parent().remove();
				
			}
		});
			
	})

jQuery(document).ready(function($) 
{
	

	

/*
	$(".addRegraProgressao").on("submit", function ( event )
	{
		event.preventDefault();
		var form = $(this).find(':input');
		var formArray = form.serializeArray();
		var jsonArray = JSON.stringify(formArray);
		//console.log(formArray[0].value);

		if (formArray[0].value == formArray[1].value)
		{
			alert("Progressão inválida. Nível inicial e nível final devem ser diferentes!");
		}
		else if (formArray[3].value <= 0)
		{
			alert("Pontuação inválida. Escolhe um valor maior que 0.");
		}
		else
		{
			$.post("http://localhost/sigprog/index.php/progressao/add", {
				'jsonArray' : jsonArray
			}, function ( response )
			{
				if (response)
				{
					alert("Regra de progressão adicionada com sucesso!");
				}
			});
		}
	});

	$(".editRegraProgressao").on("submit", function (event)
	{
		event.preventDefault();
		var form = $(this).find(':input');
		var formArray = form.serializeArray();
		var jsonArray = JSON.stringify(formArray);
		var me = $(this);
		
		//Preciso acessar o id para saber qual a posição no vetor ni e nf do form atual
		var splitId = me.attr("id").split('-');
		var id = splitId[1];

		var ni_original = ni[id];
		var nf_original = nf[id];

		console.log(ni_original+' '+nf_original);
		console.log(jsonArray);
		if (formArray[0].value == formArray[1].value)
		{
			alert("Progressão inválida. Nível inicial e nível final devem ser diferentes!");
		}
		else if (formArray[3].value <= 0)
		{
			alert("Pontuação inválida. Escolha um valor maior que 0.");
		}
		else
		{
			$.post("http://localhost/sigprog/index.php/progressao/update", {
				'jsonArray' : jsonArray,
				'ni_o' : ni_original,
				'nf_o' : nf_original
			}, function ( response )
			{
				if (response)
				{
					alert("Alterado com sucesso!");
					ni[id] = formArray[0].value;
					nf[id] = formArray[1].value;
					//me.find(":input[nivelinicial_o]").val();
					//me.find(":input[nivelfinal_o]").val(formArray[3].value);
				}
				else
				{
					alert("Algo errado não está certo.");
				}
			});

		}
	});*/

	
});