	<main>
	<div class="row">
			
			<div class="col s12">
				<h4 class="center-align">Adicionar nova Métrica</h4>
			</div>
			
			<div class="col s12">
			<form id="addMetrica" class="add-input" name="metrica">

			<div class="input-field col s10">
	            <input id="nome_metrica" name="nome_metrica" type="text" class="validate">
	            <label for="nome_metrica">Nome da Métrica</label>
			</div>

			<div class="col s2">
				<button class="btn-floating btn-medium waves-effect waves-light" type="submit">
					<i class="material-icons right">add</i>
		  		</button>				
			</div>
			</form>
			</div>

		<div id="listItens" class="row">
			<div class="col s12">
				<h4 class="center-align">Lista de Métricas</h4>
			</div>

			<div class="input-field col s10">Métricas</div>
		
<?php 
	foreach ($metricas as $metrica) { 
		$formid = "metrica-".$metrica['id_metrica'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editMetrica">

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE MÉTRICAS !-->
			<div class="input-field col s10">
	            <input class="autoupdate-input" name="nome_metrica" value="<?php echo $metrica['nome_metrica'];?>" type="text" class="validate">
	            <label for="nome_metrica">Nome</label>
			</div>
<!--  FIM DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

			<div class="col s2">
				<button form="<?php echo $formid;?>" class="btn-floating btn-medium waves-effect waves-light delete-button" type="button">
					<i class="material-icons right">remove</i>
		  		</button>				
			</div>

			</form>
			</div>
<?php 
	} ?>
	
		</div>
		
	</div>
	</main>
</div>
	<div style="height: 40%"></div>

</body>

<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
    $('select').material_select('update');
  });
</script>