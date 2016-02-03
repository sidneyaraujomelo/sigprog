	<main>
	<div class="row">
			
			<div class="col s12">
				<h4 class="center-align">Adicionar nova regra de Progressão</h4>
			</div>
			
			<div class="col s12">
			<form id="addRegraProgressao" class="add-input" name="progressao">
			<div class="input-field col s3">
				<select name="nivelinicial" form="addRegraProgressao">
			    	<option value="" disabled selected>Escolha o nível inicial</option>
<?php 
	foreach ($nivel as $niv) {
?>
					<option  value="<?php echo $niv['id_nivel']; ?>"><?php echo $niv['nome_nivel'];?></option>
<?php
	}
?>
					<label>Nivel inicial</label>
			    </select>
			</div>

			<div class="input-field col s3">
				<select name="nivelfinal" form="addRegraProgressao">
			      <option value="" disabled selected>Escolha o nível final</option>
<?php 
	foreach ($nivel as $niv) {
?>
					<option value="<?php echo $niv['id_nivel']; ?>"><?php echo $niv['nome_nivel'];?></option>
<?php
	}
?>
			      <label>Nível final</label>
			    </select>
			</div>
			<div class="input-field col s2">
	            <input id="intersticio" name="intersticio" type="number" class="validate">
	            <label for="intersticio">Interstício (semestres)</label>
			</div>

			<div class="input-field col s2">
	            <input id="pontuacao" name="pontuacao" type="number" class="validate">
	            <label for="pontuacao">Pontuação</label>
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
				<h4 class="center-align">Lista de Regras de Progressão</h4>
			</div>

			<div class="input-field col s3">Nivel inicial</div>
			<div class="input-field col s3">Nivel final</div>
			<div class="input-field col s2">Duração do Intersticio</div>
			<div class="input-field col s2">Pontuação</div>
		
<?php 
	foreach ($progressoes as $prog) { 
		$formid = "progressao-".$prog['id_progressao'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editRegraProgressao">

<!--  INICIO DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
			<div class="input-field col s3">
				<select name="fk_nivel_anterior" class="autoupdate-input" form="<?php echo $formid;?>">
<?php 
		foreach ($nivel as $niv) {
			$aux = '';
			if ($niv['id_nivel']==$prog['fk_nivel_anterior'])	$aux = 'selected';
?>
					<option  value="<?php echo $niv['id_nivel'];?>" <?php echo $aux;?> ><?php echo $niv['nome_nivel'];?></option>
<?php
		}
?>
				</select>
			</div>
<!--  FIM DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD NIVEL FINAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
			<div class="input-field col s3">
				<select name="fk_nivel_seguinte" class="autoupdate-input" form="<?php echo $formid;?>">
<?php 
		foreach ($nivel as $niv) {
			$aux = '';
			if ($niv['id_nivel']==$prog['fk_nivel_seguinte'])	$aux = 'selected';
?>
					<option  value="<?php echo $niv['id_nivel'];?>" <?php echo $aux;?> ><?php echo $niv['nome_nivel'];?></option>
<?php
		}
?>
				</select>
			</div>
<!--  FIM DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD INTERSTICIO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="duracao_intersticio" value="<?php echo $prog['duracao_intersticio'];?>" type="number" class="validate">
	            <label for="intersticio">Interstício em Semestres</label>
			</div>
<!--  FIM DO INPUT FIELD INTERSTICIO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="pontuacao" value="<?php echo $prog['pontuacao'];?>" type="number" class="validate">
	            <label for="pontuacao">Pontuação</label>
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