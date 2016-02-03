	<main>
	<div class="row">
			<div class="col s12">
				Eixo selecionado: <?php echo $eixo['nome_eixo'];?>
			</div>

			<div class="col s12">
				<h4 class="center-align">Adicionar novo Subeixo</h4>
			</div>
			
			<div class="col s12">
				<form id="addSubeixo" class="add-input" name="subeixo">

				<input id="ideixo" name="ideixo" value="<?php echo $eixo['id_eixo'];?>" type="hidden">

				<div class="input-field col s8">
		            <input id="nome" name="nome" type="text" class="validate">
		            <label for="nome">Nome</label>
				</div>

				<div class="input-field col s2">
		            <input id="pontuacao_maxima" name="pontuacao_maxima" type="number" class="validate">
		            <label for="pontuacao_maxima">Pont. Max.</label>
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
				<h4 class="center-align">Lista de Subeixos</h4>
			</div>

			<div class="input-field col s8">Nome</div>
			<div class="input-field col s2">Pontuação Máxima</div>
			<div class="input-field col s2"></div>
<?php 
	foreach ($subeixos as $subeixo) { 
		$formid = "subeixo-".$subeixo['id_subeixo'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editSubeixo">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s8">
	            <input class="autoupdate-input" name="nome_subeixo" value="<?php echo $subeixo['nome_subeixo'];?>" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="pontmax_subeixo" value="<?php echo $subeixo['pontmax_subeixo'];?>" type="number" class="validate">
			</div>
<!--  INICIO DO FIM FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

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