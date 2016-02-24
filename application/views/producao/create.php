	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Adicionar Nova Produção</h4>
			</div>

			<div class="col s12">
				<form id="addProducao" class="" method="post" name="producao" action="addProducao" enctype="multipart/form-data">
				<input type="hidden" name="token" value="<?php echo $token; ?>" />

				<hr>
				<div class="input-field col s8">
		            <input id="nome" name="nome" type="text" class="validate">
		            <label for="nome">Alias</label>
				</div>

				<div class="input-field col s4">
					<input type="text" class="datepicker" id="data_producao" name="data_producao">
					<label for="data_producao">Data da Produção</label>
				</div>

				<div class="input-field col s12">
					<select name="eixo" class="addProd_eixo" form="addProducao">
						<option value="0" selected>Selecione um eixo</option>
<?php foreach ($infoproducao as $eixo) {
?>
						<option value="<?php echo $eixo['id_eixo']; ?>"><?php echo $eixo['nome_eixo'];?></option>
<?php }?>

		            </select>
					<label for="eixo">Eixo</label>
				</div>

<?php foreach ($infoproducao as $eixo) {
?>
				<div class="input-field col s12" id="sub-de-<?php echo $eixo['id_eixo']; ?>" name="subeixo" style="display: none">
					<select name="sub-de-<?php echo $eixo['id_eixo']; ?>" class="addProd_subeixo" form="addProducao">
						<option value="0" selected>Selecione um subeixo</option>
<?php 	foreach ($eixo['subeixo'] as $subeixo) {
?>
						<option name="<?php echo $subeixo['id_subeixo']; ?>" value="<?php echo $subeixo['id_subeixo']; ?>"><?php echo $subeixo['nome_subeixo'];?></option>
<?php 	}?>						
					</select>
					<label for="subeixo">Subeixo</label>
				</div>
<?php }?>

<?php foreach ($infoproducao as $eixo) {
		foreach ($eixo['subeixo'] as $subeixo) {
?>
				<div class="input-field col s12" id="item-de-<?php echo $subeixo['id_subeixo']; ?>" name="item" style="display: none">
					<select name="item-de-<?php echo $subeixo['id_subeixo']; ?>" class="addProd_item" form="addProducao">
						<option value="0" selected>Selecione um item</option>
<?php 	foreach ($subeixo['item'] as $item) {
?>
						<option value="<?php echo $item['id_item']; ?>"><?php echo $item['nome_item'];?></option>
<?php 	}?>						
					</select>
					<label for="item">Item</label>
				</div>
<?php 	}
	  }?>
	  			<hr>
			    <div id="input-quantidade">
				</div>

				<div class="col s12 file-field input-field">
			    	<div class="btn">
			        	<span>Anexar Documentação Comprobatória</span>
			        	<input type="file" name="fileToUpload" id="fileToUpload">
			      	</div>
			      	<div class="file-path-wrapper">
			        	<input class="file-path validate" type="text">
			      	</div>
			    </div>
			    <hr>
			    <div class="col s12" id="submit-button" style="display: none">
		    		<button class="btn waves-effect waves-light green darken-4" type="submit" name="action">Adicionar
						<i class="material-icons right">add</i>
					</button>
				</div>

				</form>
			</div>


		</div>
		<div style="height: 40%"></div>
	</main>
</body>

<script type="text/javascript">


$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    monthsFull: [ 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ],
    monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
    weekdaysFull: [ 'domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado' ],
    weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
    today: 'hoje',
    clear: 'limpar',
    close: 'fechar',
    format: 'dddd, d !de mmmm !de yyyy',
    formatSubmit: 'yyyy/mm/dd',
    clear: 'limpar'
  });

$(document).ready(function() {
    $('select').material_select();
    $('select').material_select('update');
  });

</script>