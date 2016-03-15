	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Documentação Pendente</h4>
			</div>
			
			<div class="col s12">
				<hr>
				<h5>Interstício</h5>
			</div>

			<div class="col s6">
				<div class="center-align">
					<span>Início do Interstício: <?php echo date("d/m/Y", strtotime($progressaoAtual['data_inicio']));?> </span>
				</div>
			</div>

			<div class="col s6">
				<div class="center-align">
					<span>Fim do Interstício : <?php echo date("d/m/Y", strtotime($progressaoAtual['data_fim']));?> </span>
				</div>
			</div>

		</div> 

		<div class="row">
			<ul class="collapsible" data-collapsible="accordion" style="line-height: 3rem; width:auto;">
		    	<li>
		    		<div class="collapsible-header blue darken-4" style="line-height: 3rem; font-weight: bold; color:white">
			      		<div class="col s2"><span class="truncate">Data</span></div>
			      		<div class="col s1"><span class="truncate">Eixo</span></div>
			      		<div class="col s1"><span class="truncate">Subeixo</span></div>
			      		<div class="col s3"><span class="truncate">Item</span></div>
			      		<div class="col s3"><span class="truncate">Alias</span></div>
			      		<div class="col s1"><span class="truncate">Pontos</span></div>
			      		<div class="col s1"><span class="truncate">Documentacao</span></div>
		      		</div>
			    </li>
<?php foreach ($producoes as $producao) {
		$formid = "producao-".$producao['id_producao'];?>
				
			    <li>
			      	<div class="collapsible-header col s12">
			      		<div class="col s2"><p class="truncate data-selector"><?php echo $producao['data_producao']; ?></p></div>
			      		<div class="col s1"><p class="truncate"><?php echo $producao['nome_eixo']; ?></p></div>
			      		<div class="col s1"><p class="truncate"><?php echo $producao['nome_subeixo']; ?></p></div>
			      		<div class="col s3"><p class="truncate"><?php echo $producao['nome_item']; ?></p></div>
			      		<div class="col s3"><p id="nome_producao_<?php echo $producao['id_producao']; ?>" class="truncate"><?php echo $producao['nome_producao']; ?></p></div>
			      		<div class="col s1"><p id="pontuacao_producao_<?php echo $producao['id_producao']; ?>" class="truncate"><?php echo $producao['pontuacao_producao']; ?></p></div>
			      		<div class="col s1">
			      			<p id="documento_producao_<?php echo $producao['id_producao']; ?>" class="truncate">
			      				<?php echo (isset($producao['documento_producao']) ? 
			      					'<a target="_blank" href="'.uploads_url().'/'.$producao['documento_producao'].'">Comprovante</a>' : 
			      					'Pendente');?>
	      					</p>
      					</div>
			      	</div>
			      	<div class="collapsible-body col s12 blue lighten-5">
			      		<form id="<?php echo $formid;?>" class="editProducao">
						<div class="input-field col s12" style="margin-top: 3em;">
						    <input id="nome_producao" name="nome_producao" type="text" value="<?php echo $producao['nome_producao']; ?>" class="autoupdate-producao validate">
						    <label for="nome_producao">Alias</label>
						</div>
<?php 	if (isset($producao['quantidade_producao'])) {?>
						<div class="input-field col s6" style="margin-top: 3em;">
							<input id="quantidade_producao" name="quantidade_producao" type="text" value="<?php echo  $producao['quantidade_producao']; ?>" class="autoupdate-producao validate">
						    <label for="quantidade_producao">Quantidade</label>
						</div>
<?php 	} else { ?>
						<div class="input-field col s6" style="margin-top: 3em;">
							<input id="quantidade_producao" name="quantidade_producao" type="text" class="autoupdate-producao validate" disabled>
						    <label for="quantidade_producao">Quantidade Indisponível</label>
						</div>
<?php		} 
 		if (isset($producao['id_classificacao'])) {?>
						<div class="input-field col s6" style="margin-top: 3em;">
							<select name="fk_classificacao" class="autoupdate-producao">
								<option value="" disabled>Escolha o tipo de regra</option>
<?php 		foreach ($classes[$producao['id_tipoclass']] as $classe ) {
				$selected = '';
				if ($producao['id_classificacao'] == $classe['id_classificacao'])	$selected = 'selected'; ?>
								<option value="<?php echo $classe['id_classificacao']; ?>" <?php echo $selected; ?>><?php echo $classe['nome_classificacao']; ?></option>
<?php 		} ?>
							</select>
						</div>
<?php 	} else { ?>
						<div class="input-field col s6" style="margin-top: 3em;">
							<input id="classificacao" name="fk_classificacao" type="text" class="autoupdate-producao validate" disabled>
						    <label for="fk_classificacao">Classificação Indisponível</label>
						</div>
<?php 	} ?>
						</form>

<?php 	for ($i = 0; $i < $producao['ndecorrentes']; $i++) { 
			if (isset($producao['decorrentes'][$i])) {
				$formid = "producaodecorrente-".$producao['decorrentes'][$i]['id_decorrencia'];
			}
			else {
				$formid = "producaodecorrente-";
			} ?>
						<form id="<?php echo $formid; ?>" name="regradecorrente">
						<input type="hidden" id="fk_producao_principal" name="fk_producao_principal" value="<?php echo $producao['id_producao']; ?>">
						<div class="input-field col s12">
							<select name="fk_producao_decorrente" class="autoupdate-producao">
								<option value="">Escolha uma Produção</option>
<?php 		foreach ($producao['associaveis'] as $associavel) { 
				$selected = '';
				if ($producao['decorrentes'][$i]['id_producao'] == $associavel['id_producao']){
					$selected='selected';
				}?>
								<option value="<?php echo $associavel['id_producao'] ?>" <?php echo $selected; ?> ><?php echo $associavel['nome_producao'] ?></option>
<?php 		} ?>
							</select>
						</div>
						</form>
<?php 	} ?>

<?php 	$formid = "producao-".$producao['id_producao'];?>
						<form id="<?php echo $formid; ?>" class="editDocumento" method="post" name="documento" action="<?php echo base_url().'/index.php/producao/addDocumento/'.$producao['id_producao'];?>" enctype="multipart/form-data">
						<div class="col s12 file-field input-field">
					    	<div class="btn">
					        	<span>Anexar Documentação Comprobatória</span>
					        	<input type="file" name="fileToUpload" id="fileToUpload">
					      	</div>
					      	<div class="file-path-wrapper">
					        	<input class="file-path validate" type="text">
					      	</div>
					    </div>

					    <div class="col s12" style="margin-bottom: 1em;" id="submit-button">
				    		<button class="btn waves-effect waves-light green darken-4" style="width:100%;" type="submit" name="action">Enviar Comprovante
								<i class="material-icons right">send</i>
							</button>
						</div>
						</form>
<?php if ($producao['data_producao'] > $progressaoAtual['data_inicio']) { ?>
						<hr>
						<div class="col s12" style="margin-bottom: 1em;" id="fake-button">
				    		<button class="btn waves-effect waves-light green darken-4" style="width:100%;" type="submit" name="action">Salvar Alterações
								<i class="material-icons right">save</i>
							</button>
						</div>
						<div class="col s12" style="margin-bottom: 1em;">
				    		<button id="delete-producao-button" class="btn waves-effect waves-light red darken-4" style="width:100%;" type="submit" name="<?php echo $producao['id_producao']; ?>">Remover Produção
								<i class="material-icons right">delete</i>
							</button>
						</div>
<?php } ?>
			      	</div>
			    </li>
			
<?php } ?>
		  </ul>
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

$(document).ready(function(){
	$('.quickfit').quickfit({ max: 20, min: 8, truncate: true }); 
});
</script>