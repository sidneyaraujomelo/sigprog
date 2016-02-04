	<main>

	<div class="row">
		<div class="col s12">
<?php foreach ($itensPath as $itemPath) { ?>
				<a href="<?php echo $itemPath['url']; ?>"><?php echo $itemPath['nome']; ?></a>
				
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
				<label for="fk_metrica">Métrica</label>

			</div>

			<div class="input-field col s12">
				<select name="fk_tipoclass" class="autoupdate-input tipoclass-input" form="<?php echo $formid;?>">
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
				<label for="fk_tipoclass">Tipo de Classificação</label>
			</div>

<!--  INICIO DO INPUT FIELD FORMULA DA FORMULÁRIO DE EDIÇÃO DE REGRAS DE ITEM !-->
			<div class="input-field col s12">
	            <input class="autoupdate-input" name="formula_regra" value="<?php echo $regra['formula_regra'];?>" type="text" class="validate">
	            <label for="formula_regra">Fórmula</label>
			</div>
<!--  INICIO DO FIM FIELD FORMULA DA FORMULÁRIO DE EDIÇÃO DE REGRAS DE ITEM !-->

			</form>
			</div>

<?php
$visible_regrasclass = 'none';
if ($regra['fk_tipoclass']!=1)
{
	$visible_regrasclass = 'block';
} ?>
			<div id="regras_classificacao" style="display: <?php echo $visible_regrasclass; ?>">
				<table class="col s3 offset-s2">
					<thead>
						<tr>
							<th data-field="classificacao">Classificação</th>
							<th data-field="valor">Valor</th>
						</tr>
					</thead>

					<tbody>

<?php
		for ($i=0; $i < count($classes) ; $i=$i+2) { 
			$classe = $classes[$i];
?>
						<tr>
							<td><?php echo $classe['nome_classificacao'];?></td>
							<td>
								<form id="<?php echo 'regra_classificacao-'.$classe['id_classificacao']; ?>" class="editItem">
									<input type="hidden" id="regra" value="<?php echo $regra['id_item']; ?>">
									<input type="hidden" id="classe" value="<?php echo $classe['id_classificacao']; ?>">
									<input class="autoupdate-regraclass" form="<?php echo 'regra_classificacao-'.$classe['id_classificacao']; ?>" name="valor" value="<?php echo $classe['valor'];?>" type="number" step="0.1">
								</form>
							</td>
						</tr>
<?php
		}
?>
					</tbody>
				</table>

				<table class="col s3 offset-s2">
					<thead>
						<tr>
							<th data-field="classificacao">Classificação</th>
							<th data-field="valor">Valor</th>
						</tr>
					</thead>

					<tbody>

<?php
	if (count($classes)>1)
		for ($i=1; $i < count($classes) ; $i=$i+2) { 
			$classe = $classes[$i];
?>
						<tr>
							<td><?php echo $classe['nome_classificacao'];?></td>
							<td>
								<form id="<?php echo 'regra_classificacao-'.$classe['id_classificacao']; ?>" class="editItem">
									<input type="hidden" id="regra" value="<?php echo $regra['id_item']; ?>">
									<input type="hidden" id="classe" value="<?php echo $classe['id_classificacao']; ?>">
									<input class="autoupdate-regraclass" form="<?php echo 'regra_classificacao-'.$classe['id_classificacao']; ?>" name="valor" value="<?php echo $classe['valor'];?>" type="number" step="0.1">
								</form>
							</td>
						</tr>
<?php
		}
?>
					</tbody>
				</table>
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