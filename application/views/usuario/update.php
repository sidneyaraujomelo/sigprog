	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Dados do Professor</h4>
			</div>

			<div class="col s12">
				<hr>
			</div>

			<div class="col s12">
<?php $formid='usuario-'.$professor['siape'] ;?>
			<form id="<?php echo $formid;?>">

				<div class="input-field col s12">
	            	<input class="autoupdate-general" name="nome" value="<?php echo $professor['nome'];?>" type="text" class="validate">
	            	<label for="nome">Nome</label>
				</div>

				<div class="input-field col s12">
	            	<input class="autoupdate-general" name="email" value="<?php echo $professor['email'];?>" type="text" class="validate">
	            	<label for="email">E-mail</label>
				</div>

			</form>
			</div>

<?php if ($incomplete) { ?>
			<div class="col s12">
				
				<strong>Informe abaixo dados relacionados à sua última progressão:</strong>
				<br>
				<span>Atenção aos níveis da classe A, não os confunda com os níveis homônimos das classes B e C.</span>
			</div>

			<div class="col s12">
			<?php $formid='professorprog-'.$professor['siape'] ;?>
			<form id="<?php echo $formid;?>" action="<?php echo base_url().'index.php/usuario/startprogressao'; ?>" name="professor">
			
			<div class="input-field col s12">
				<select id="unidadeacademica" name="fk_unid_academica" form="<?php echo $formid; ?>" required>
			    	<option value="" disabled selected>Informe sua Unidade Acadêmica</option>
<?php foreach ($unidadesAcademicas as $unidade): 
		$status = '';
		if (isset($professor['unidAcad']) && ($unidade['id_unid_academica']==$professor['fk_unid_academica'])) $status='selected'; ?>
					<option  value="<?php echo $unidade['id_unid_academica']; ?>" <?php echo $status;?>><?php echo $unidade['nome_unid_academica'];?></option>
<?php endforeach ?>
					<label>Unidade Acadêmica Atual</label>
			    </select>
			</div>

			<div class="input-field col s12">
				<select id="depto" name="fk_depto" form="<?php echo $formid; ?>" required>
			    	<option value="" disabled selected>Informe seu Departamento</option>
<?php foreach ($departamentos as $depto): 
		$status = '';
		if (isset($professor['depto']) && ($depto['id_depto']==$professor['fk_depto'])) $status='selected'; ?>
					<option  value="<?php echo $depto['id_depto']; ?>" <?php echo $status;?>><?php echo $depto['nome_depto'];?></option>
<?php endforeach ?>
					<label>Departamento</label>
			    </select>
			</div>

			<div class="input-field col s12">
				<select id="regime" name="fk_regime_trabalho" form="<?php echo $formid; ?>" required>
			    	<option value="" disabled selected>Informe seu Regime</option>
<?php foreach ($regimes as $regime): 
		$status = '';
		if (isset($professor['regime']) && ($regime['id_regime']==$professor['fk_regime_trabalho'])) $status='selected'; ?>
					<option  value="<?php echo $regime['id_regime']; ?>" <?php echo $status;?>><?php echo $regime['nome_regime'];?></option>
<?php endforeach ?>
					<label>Regime de Trabalho</label>
			    </select>
			</div>

			<div class="input-field col s12">
				<select id="titulo" name="fk_titulo" form="<?php echo $formid; ?>" required>
			    	<option value="" disabled selected>Informe seu título</option>
<?php foreach ($titulos as $titulo): 
		$status = '';
		if (isset($professor['titulo']) && ($titulo['id_titulo']==$professor['fk_titulo'])) $status='selected'; ?>
					<option  value="<?php echo $titulo['id_titulo']; ?>" <?php echo $status;?>><?php echo $titulo['nome_titulo'];?></option>
<?php endforeach ?>
					<label>Título Atual</label>
			    </select>
			</div>

			<div class="input-field col s12">
				<select id="nivel" name="fk_nivel" form="<?php echo $formid; ?>" required>
			    	<option value="" disabled selected>Informe seu nível</option>
<?php foreach ($niveis as $niv): 
		$status = '';
		if (isset($professor['nivel']) && ($niv['id_nivel']==$professor['fk_nivel'])) $status='selected'; ?>

					<option  value="<?php echo $niv['id_nivel']; ?>" <?php echo $status;?>><?php echo $niv['nome_nivel'];?></option>
<?php endforeach ?>
					<label>Nivel Atual</label>
			    </select>
			</div>

			<div class="input-field col s12">
					<input type="text" class="datepicker" id="data_progressao" name="data_progressao" 
					<?php if (isset($professor['ultimaProgressao']))
					 	echo "\"value=\"".$professor['ultimaProgressao']."\"";  ?>required>
					<label for="data_progressao">Data da Última Progressão</label>
			</div>

			<div class="col s12">
	    		<a class="btn waves-effect waves-light green darken-4 modal-trigger" href="#modal1" style="width:100%">Salvar alterações
					<i class="material-icons right">save</i>
				</a>
			</div>

			<div id="modal1" class="modal">
				<div class="modal-content">
					Você tem certeza que as informações estão corretas?
				</div>
				<div class="modal-footer">
					<a class="modal-action modal-close waves-effect waves-green btn-flat">Não</a>
					<a id="start-progressao" class="modal-action modal-close waves-effect waves-green btn-flat">Sim</a>
				</div>
			</div>
			</form>
			</div>
<?php } else { ?>
			<div class="col s12">
	    		<a class="btn waves-effect waves-light green darken-4" id="fake-button" style="width:100%">Salvar alterações
					<i class="material-icons right">save</i>
				</a>
			</div>
<?php } ?>
			</div>
	</main>	

<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
    $('select').material_select('update');
    $('.modal-trigger').leanModal();
  });


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
</script>