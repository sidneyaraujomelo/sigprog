	<main>
	<div class="row">
			<div class="col s12">
<?php foreach ($itensPath as $itemPath) { ?>
				<a href="<?php echo $itemPath['url']; ?>"><?php echo $itemPath['nome']; ?></a>
				>
<?php } ?>
			</div>

			<div class="col s12">
				<h4 class="center-align">Adicionar novo Item</h4>
			</div>
			
			<div class="col s12">
				<form id="addItem" class="add-input" name="item">

				<input id="idsubeixo" name="idsubeixo" value="<?php echo $subeixo['id_subeixo'];?>" type="hidden">

				<div class="input-field col s6">
		            <input id="nome" name="nome" type="text" class="validate">
		            <label for="nome">Nome</label>
				</div>

				<div class="input-field col s2">
		            <input id="pontuacao_maxima" name="pontuacao_maxima" type="number" step="0.1" class="validate">
		            <label for="pontuacao_maxima">Pont. Max.</label>
				</div>

				<div class="input-field col s2">
		            <input id="quantidade_maxima" name="quantidade_maxima" type="number" step="0.1" class="validate">
		            <label for="quantidade_maxima">Quant. Max.</label>
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
				<h4 class="center-align">Lista de Items</h4>
			</div>

			<div class="input-field col s6">Nome</div>
			<div class="input-field col s2">Pontuação Máxima</div>
			<div class="input-field col s2">Quantidade Máxima</div>
			<div class="input-field col s2"></div>
<?php 
	foreach ($itens as $item) { 
		$formid = "item-".$item['id_item'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editItem">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->
			<div class="input-field col s6">
	            <input class="autoupdate-input" name="nome_item" value="<?php echo $item['nome_item'];?>" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="pontmax_item" value="<?php echo $item['pontmax_item'];?>" type="number" class="validate">
			</div>
<!--  INICIO DO FIM FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="quantmax_item" value="<?php echo $item['quantmax_item'];?>" type="number" class="validate">
			</div>
<!--  INICIO DO FIM FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE ITEM !-->

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