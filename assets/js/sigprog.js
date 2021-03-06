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

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

$.ajaxSetup ({
	// Disable caching of AJAX responses
	cache: false
});

$(document).on('change', '.addProd_eixo', function(){
	var val = $(this).val();
	if (val != '')
	{
		$("div[id^='sub-de-']").each(function(){
			console.log($(this));
			$(this).css("display", "none");
		});
		$("div[id^='item-de-']").each(function(){
			console.log($(this));
			$(this).css("display", "none");
		});
		$('#submit-button').css("display", "none");
		$("#sub-de-"+val).css("display", "block");
		$("#input-quantidade").empty();
	}
});

$(document).on('change', '.addProd_subeixo', function(){
	var val = $(this).val();
	if (val != '')
	{
		$("div[id^='item-de-']").each(function(){
			console.log($(this));
			$(this).css("display", "none");
		});
		$('#submit-button').css("display", "none");
		$("#item-de-"+val).css("display", "block");
		$("#input-quantidade").empty();
	}
});

$(document).on('change', '.addProd_item', function(){
	var val = $(this).val();

	if (val != '' && val!=null)
	{
		$.post("/sigprog/index.php/regra/generateProdForm/",
		{
			'id' : val
		},function(response)
		{
			console.log(response);
			$("#input-quantidade").empty().append(response);
			$('select').material_select();
    		$('select').material_select('update');
    		$('input#input_text, textarea#textarea1').characterCounter();
    		$('#submit-button').css("display", "block");
		});
	}
});

$(document).on('change', '.autoupdate-producao', function(){
    //alert( this.value ); // or $(this).val()
	  var attrId = $(this).closest("form").attr("id");
	  var form = $(this).closest("form");
	  var tabela = attrId.split('-')[0];
	  var id = attrId.split('-')[1];
	  var col = $(this).attr("name");
	  var val = $(this).val();
	  console.log(tabela+" "+id+" "+col+" "+val);

	  if (tabela!=null && id != null && col!=null && val != null)
	  {
	  	if (id != '')
	  	{
		  	$.post("/sigprog/index.php/producao/update",
		  	{
		  		'tabela' : tabela,
		  		'id' : id,
		  		'col' : col,
		  		'val' : val
		  	}, function (response)
		  	{
		  		if (col=="nome_producao")
		  		{
		  			form.parent().parent().find("#nome_producao_"+id).html(val);
		  		}
		  		console.log(response);
		  		Materialize.toast('Atualizado com sucesso!', 4000);
		  		//alert("Atualização realizada com sucesso!");
		  	});
	  	}
	  	else
	  	{
	  		var id_principal = $(this).closest("form").find("#fk_producao_principal").val();
	  		$.post("/sigprog/index.php/producao/addDecorrente",
	  		{
	  			'fk_producao_principal'	: id_principal,
	  			'fk_producao_decorrente' : val
	  		}, function (response)
	  		{
	  			Materialize.toast('Atualizado com sucesso!', 4000);
	  			console.log(response);
	  			form.attr("id", attrId+response);
	  		});
	  	}
	  }
});

$(document).on('change', '.autoupdate-general', function(){
    //alert( this.value ); // or $(this).val()
	  var attrId = $(this).closest("form").attr("id");
	  var form = $(this).closest("form");
	  var tabela = attrId.split('-')[0];
	  var id = attrId.split('-')[1];
	  var col = $(this).attr("name");
	  var val = $(this).val();
	  console.log(tabela+" "+id+" "+col+" "+val);

	  if (tabela!=null && id != null && col!=null && val != null)
	  {
	  	if (id != '')
	  	{
		  	$.post("/sigprog/index.php/"+tabela+"/update",
		  	{
		  		'tabela' : tabela,
		  		'id' : id,
		  		'col' : col,
		  		'val' : val
		  	}, function (response)
		  	{
		  		if (col=="nome_producao")
		  		{
		  			form.parent().parent().find("#nome_producao_"+id).html(val);
		  		}
		  		console.log(response);
		  		Materialize.toast('Atualizado com sucesso!', 4000);
		  		//alert("Atualização realizada com sucesso!");
		  	});
	  	}
	  }
});

$(document).on('change', '.autoupdate-input', function(){
    //alert( this.value ); // or $(this).val()
    var form = $(this).closest("form");
	  var attrId = $(this).closest("form").attr("id");
	  var tabela = attrId.split('-')[0];
	  var id = attrId.split('-')[1];
	  var col = $(this).attr("name");
	  var val = $(this).val();
	  console.log(tabela+" "+id+" "+col+" "+val);

	  if (tabela!=null && id != null && col!=null && val != null)
	  {
	  	$.post("/sigprog/index.php/admin/update",
	  	{
	  		'tabela' : tabela,
	  		'id' : id,
	  		'col' : col,
	  		'val' : val
	  	}, function (response)
	  	{
	  		console.log(response);
	  		Materialize.toast('Atualizado com sucesso!', 4000);
	  		//alert("Atualização realizada com sucesso!");
	  	});
	  }
});

$(document).on('click', '#start-progressao', function(){
	var form = $(this).closest("form");

	var siape = form.attr("id").split('-')[1];
	var titulo = form.find("#titulo").val();
	var nivel = form.find("#nivel").val();
	var unidade = form.find("#unidadeacademica").val();
	var depto = form.find("#depto").val();
	var regime = form.find("#regime").val();
	var dataProgressao = form.find("#data_progressao").parent().find("input:hidden").val().replaceAll("/","-");

	if (siape && titulo && nivel && dataProgressao && unidade && depto && regime)
	{
		$.post("/sigprog/index.php/usuario/startprogressao",
		{
			'siape' : siape,
			'titulo' : titulo,
			'nivel' : nivel,
			'unidade' : unidade,
			'depto' : depto,
			'regime' : regime,
			'data' : dataProgressao
		}, function (response)
		{
			console.log(response);
			location.replace("/sigprog/");
		});
	}
	else
	{
		Materialize.toast('Dados inválidos!', 4000);
	}
});

$(document).on('change', '.autoupdate-regraclass', function(){
    //alert( this.value ); // or $(this).val()
	  var attrId = $(this).closest("form").attr("id");
	  
	  var tabela = attrId.split('-')[0];
	  var regra = $(this).closest("form").find("#regra").val();
	  var classe = $(this).closest("form").find("#classe").val();
	  var val = $(this).val();
	  var col = $(this).attr("name");

	  console.log(tabela+" "+regra+" "+classe+" "+col+" "+val);

	  if (tabela!=null && regra != null && classe!=null && val != null)
	  {
	  	$.post("/sigprog/index.php/regraclassificacao/updateregraclasse",
	  	{
	  		'tabela' : tabela,
	  		'regra' : regra,
	  		'classe' : classe,
	  		'col' : col,
	  		'val' : val
	  	}, function (response)
	  	{
	  		console.log(response);
	  		Materialize.toast('Atualizado com sucesso!', 4000);
	  		//alert("Atualização realizada com sucesso!");
	  	});
	  }
});

$(document).on('change', '.tipoclass-input', function(){
    //alert( this.value ); // or $(this).val()
    var val = $(this).val();
    console.log(val);
    if (val == null || val == "") return;
    $(".regraclassificacao").css("display", "none");
    if (val != 1)
    {
    	console.log("#regras_classificacao-"+val);
		$( "#regras_classificacao-"+val ).css( "display", "block" );
	}
});

$(document).on('change', '.decorrente-input', function(){
    //alert( this.value ); // or $(this).val()
    var val = $(this).val();
    console.log(val);
    if (val <= 0)	
    {
    	$( "#regras_decorrentes" ).css( "display", "none" );
    }
    else			
    {
    	$( "#regras_decorrentes" ).css( "display", "block" );
    }
});

$(document).on('submit', '.add-input', function(){
		event.preventDefault();
		var form = $(this).find(':input');
		var table = $(this).attr("name");
		var formArray = form.serializeArray();
		var jsonArray = JSON.stringify(formArray);
		//console.log(table);

		
		$.post("/sigprog/index.php/"+table+"/add", {
			'jsonArray' : jsonArray
		}, function ( response )
		{
			if (response)
			{
				console.log(response);
				listItens = $("#listItens");
				$.get("/sigprog/index.php/"+table+"/generateForm/"+response, {

				},function (response2) {
					//console.log(response2);
					$("#listItens").append(response2);
					$('select').material_select();
					$('input#input_text, textarea#textarea1').characterCounter();
					
					if (table != "regradecorrente" && table != "progressao")
					{
						var nameNewMenuItem = formArray[0]["value"];
						for (var i = 0; i < formArray.length; i++) {
							if (formArray[i]["name"] == "nome")
								nameNewMenuItem = formArray[i]["value"];
						};
						//console.log(nameNewMenuItem);
						var sideMenu = $("#slide-out");
						var sibling;
						var liInnerHtmls = sideMenu.find(".truncate").each(function () {
							var currentMenuItem = $(this).html();
							var n = currentMenuItem.localeCompare(nameNewMenuItem)
							if(n == -1)
							{
								console.log($(this).html());
								sibling = $(this).closest("li");
							}
						});
						var newMenuItemHtml = "<li><a href=\""+document.URL+"/"+response+"\"><p class='truncate'>"+nameNewMenuItem+"</p></a></li>";
						console.log(newMenuItemHtml);
						if (typeof sibling === 'undefined')	$(sideMenu).prepend(newMenuItemHtml);
						else				$(sibling).after(newMenuItemHtml);
					}
					else
					{
						console.log("não precisa mexer com menu");
					}
					Materialize.toast('Adicionado com sucesso!', 4000);
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
		$.post("/sigprog/index.php/"+tabela+"/delete", {
			'id' : id
		}, function (response){
			if (response)
			{
				//alert(response);
				//alert("");
				nameMenuItem = me.closest("form").find(".autoupdate-input:first").val();
				//console.log(me.closest("form"));
				me.closest("form").parent().remove();

				if (nameMenuItem)
				{
					var sideMenu = $("#slide-out");
					var liInnerHtmls = sideMenu.find(".truncate").each(function () {
						var currentMenuItem = $(this).html();
						var n = currentMenuItem.localeCompare(nameMenuItem)
						if(n == 0)
						{
							$(this).closest("li").remove();
						}
					});
				}
				else console.log("não tem que deletar menu");
				Materialize.toast('Removido com sucesso!', 4000);
			}
		});
			
	});

$(document).on("click", "#delete-producao-button", function(){
	var id=$(this).attr("name");
	var button = $(this);
	$.post("/sigprog/index.php/producao/delete/"+id, {

	}, function(response){
		console.log(response);
		location.reload(true);
	});
});

$(document).on("click", "#fake-button", function(){
	Materialize.toast('Salvo com sucesso!', 2000);
	location.reload(true);
});

$(document).on("change", ".limit_intersticio", function(){
	var prods = $(".data-selector");
	var filterDateInicio = $("#inicio_intersticio").parent().find("input:hidden").val().replaceAll("/","-");
	var filterDateFim = $("#fim_intersticio").parent().find("input:hidden").val().replaceAll("/","-");
	prods.each(function(){
		var prodDate = $(this).html();
		console.log(prodDate+' '+filterDateInicio+' '+filterDateFim);
		if (filterDateInicio!='' && filterDateFim != '')
		{
			if (prodDate.localeCompare(filterDateInicio) < 0 || prodDate.localeCompare(filterDateFim) > 0)
			{
				$(this).closest("li").css("display","none");
			}
			else
			{
				$(this).closest("li").css("display","block");
			}
		}
		else if (filterDateInicio=='' && filterDateFim == '')
		{
			$(this).closest("li").css("display","block");
		}
		else if (filterDateInicio=='')
		{
			if (prodDate.localeCompare(filterDateFim) > 0)
			{
				$(this).closest("li").css("display","none");
			}
			else
			{
				$(this).closest("li").css("display","block");
			}
		}
		else if (filterDateFim=='')
		{
			if (prodDate.localeCompare(filterDateInicio) < 0 )
			{
				$(this).closest("li").css("display","none");
			}
			else
			{
				$(this).closest("li").css("display","block");
			}
		}
	});
});

jQuery(document).ready(function($) 
{
	
	$("#slide-out").on({
		mouseenter: function()
		{
			$(this).width("auto");
			autoWidth = $(this).width();
			if (autoWidth < 240)
			{
				$(this).width("240px");
			}
			else if (autoWidth > screen.width*0.8)
			{
				$(this).width("80%");	
			}
		},
		mouseleave: function()
		{
			$(this).width("240px");
		}
});

});