	<main>

	<div class="row">
		<div class="col s12">
<?php foreach ($itensPath as $itemPath) { ?>
				<a href="<?php echo $itemPath['url']; ?>"><?php echo $itemPath['nome']; ?></a>
				>
<?php } ?>
		</div>

			<div class="col s12">
				<h4 class="center-align"><?php echo $item['nome_item'];?></h4>
			</div>

<?php 
		$formid = "regra-".$item['id_item'];
?>
			<div class="col s12">
			<form id="<?php echo $formid;?>" class="editItem">
			<div class="input-field col s12">
				<select name="fk_metrica" class="autoupdate-input" form="<?php echo $formid;?>">
					<option value="" disabled>Escolha a métrica</option>
<?php 
		foreach ($metricas as $metrica) {
			$aux = '';
			if ($metrica['id_metrica']==$regra['fk_metrica'])	$aux = 'selected';
?>
					<option  value="<?php echo $metrica['id_metrica'];?>" <?php echo $aux;?> ><?php echo $metrica['nome_metrica'];?></option>
<?php
		}
?>
				</select>

			</div>

			<div class="input-field col s12">
				<select name="fk_tipoclass" class="autoupdate-input" form="<?php echo $formid;?>">
					<option value="" disabled>Escolha o tipo de classificação</option>
<?php 
		foreach ($tipoclasses as $tipoclass) {
			$aux = '';
			if ($tipoclass['id_tipoclass']==$regra['fk_tipoclass'])	$aux = 'selected';
?>
					<option  value="<?php echo $tipoclass['id_tipoclass'];?>" <?php echo $aux;?> ><?php echo $tipoclass['nome_tipoclass'];?></option>
<?php
		}
?>
				</select>

			</div>

<!--  INICIO DO INPUT FIELD FORMULA DA FORMULÁRIO DE EDIÇÃO DE REGRAS DE ITEM !-->
			<div class="input-field col s12">
	            <input class="autoupdate-input" name="formula_regra" value="<?php echo $regra['formula_regra'];?>" type="text" class="validate">
	            <label for="formula_regra">Fórmula</label>
			</div>
<!--  INICIO DO FIM FIELD FORMULA DA FORMULÁRIO DE EDIÇÃO DE REGRAS DE ITEM !-->

			</form>
			</div>
	</div>

	<div style="height: 40%"></div>
	</main>
</body>

<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
    $('select').material_select('update');
  });
</script>