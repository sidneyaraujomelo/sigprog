	<main>
	<div class="row">
			
			<div class="col s12">
				<h4 class="center-align">Adicionar novo Eixo</h4>
			</div>
			
			<div class="col s12">
			<form id="addEixo" class="add-input" name="eixo">

			<div class="input-field col s10">
	            <input id="nome" name="nome" type="text" class="validate">
	            <label for="nome">Nome</label>
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
				<h4 class="center-align">Lista de Eixos</h4>
			</div>

			<div class="input-field col s10">Nome</div>
		
<?php 
	foreach ($eixos as $eixo) { 
		$formid = "eixo-".$eixo['id_eixo'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editEixo">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE EIXO !-->
			<div class="input-field col s10">
	            <input class="autoupdate-input" name="nome_eixo" value="<?php echo $eixo['nome_eixo'];?>" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE EIXO !-->

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