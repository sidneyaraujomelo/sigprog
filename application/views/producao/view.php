	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Lista de Produções</h4>
			</div>
			
			<div class="col s12">
				<hr>
				<h5>Interstício</h5>
			</div>

			<div class="input-field col s6">
				<input type="date" class="datepicker" id="inicio_intersticio" name="inicio_intersticio">
				<label for="inicio_intersticio">Início do Interstício</label>
			</div>

			<div class="input-field col s6">
				<input type="date" class="datepicker" id="fim_intersticio" name="fim_intersticio">
				<label for="fim_intersticio">Fim do Interstício</label>
			</div>

		</div> 

		<div class="row">
			<ul class="collapsible" data-collapsible="accordion" style="line-height: 3rem;">
		    	<li>
		    		<div class="collapsible-header" style="line-height: 3rem; font-weight: bold;">
			      		<div class="col s1">Data</div>
			      		<div class="col s1">Eixo</div>
			      		<div class="col s1">Subeixo</div>
			      		<div class="col s4">Item</div>
			      		<div class="col s4">Alias</div>
			      		<div class="col s1">Documentacao</div>
		      		</div>
			    </li>
<?php foreach ($producoes as $producao) {
		$formid = "producao-".$producao['id_producao'];?>
				
			    <li>
			      	<div class="collapsible-header col s12">
			      		<div class="col s1"><p class="truncate"><?php echo $producao['data_producao']; ?></p></div>
			      		<div class="col s1"><p class="truncate"><?php echo $producao['nome_eixo']; ?></p></div>
			      		<div class="col s1"><p class="truncate"><?php echo $producao['nome_subeixo']; ?></p></div>
			      		<div class="col s4"><p class="truncate"><?php echo $producao['nome_item']; ?></p></div>
			      		<div class="col s4"><p class="truncate"><?php echo $producao['nome_producao']; ?></p></div>
			      		<div class="col s1"><p class="truncate"><?php echo $producao['documento_producao']; ?></p></div>
			      	</div>
			      	<div class="collapsible-body col s12">
						<div class="input-field col s12" style="margin-top: 50px;">
						    <input id="alias" name="alias" type="text" value="<?php echo $producao['nome_producao']; ?>" class="autoupdate-input validate">
						    <label for="alias">Alias</label>
						</div>
<?php 	if (isset($producao['quantidade_producao'])) {?>
						<div class="input-field col s6" style="margin-top: 50px;">
							<input id="quantidade" name="quantidade" type="text" value="<?php echo  $producao['quantidade_producao']; ?>" class="autoupdate-input validate">
						    <label for="quantidade">Quantidade</label>
						</div>
<?php 	} else { ?>
						<div class="input-field col s6" style="margin-top: 50px;">
							<input id="quantidade" name="quantidade" type="text" class="autoupdate-input validate" disabled>
						    <label for="quantidade">Quantidade Indisponível</label>
						</div>
<?php		} 
 		if (isset($producao['id_classificacao'])) {?>
						<div class="input-field col s12">
							<!-- AQUI VEM A PARTE DE SELECIONAR A CLASSIFICAÇÃO -->
						</div>
<?php 	} else { ?>
						<div class="input-field col s6" style="margin-top: 50px;">
							<input id="classificacao" name="classificacao" type="text" class="autoupdate-input validate" disabled>
						    <label for="classificacao">Classificação Indisponível</label>
						</div>
<?php 	} ?>
			      	</div>
			    </li>
			
<?php } ?>
		  </ul>
		</div>

		<div class="row">
			<table class="highlight">
		        <thead>
		          <tr>
		              <th data-field="data">Data</th>
		              <th data-field="eixo">Eixo</th>
		              <th data-field="subeixo">Subeixo</th>
		              <th data-field="item">Item</th>
		              <th data-field="nome">Alias</th>
		              <th data-field="documentacao">Documentacao</th>
		          </tr>
		        </thead>

		        <tbody>
<?php foreach ($producoes as $producao) {?>
					<tr>
					<td><?php echo $producao['data_producao']; ?></td>
					<td><?php echo $producao['nome_eixo']; ?></td>
					<td><?php echo $producao['nome_subeixo']; ?></td>
					<td><?php echo $producao['nome_item']; ?></td>
					<td><?php echo $producao['nome_producao']; ?></td>
					<td><?php echo $producao['documento_producao']; ?></td>
					</tr>
<?php } ?>
				</tbody>
	        </table>	
		</div>	

	</main>


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

$(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });
</script>