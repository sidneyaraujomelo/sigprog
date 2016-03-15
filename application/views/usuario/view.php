	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Progressão Atual</h4>
			</div>
			<hr>
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
			<div class="col s10 offset-s1">
				<div class="col s6">
					<div class="left-align">
						<strong><?php echo $progressaoAtual['nome_nivel_anterior'] ?></strong>
					</div>
				</div>
				<div class="col s6">
					<div class="right-align">
						<strong><?php echo $progressaoAtual['nome_nivel_seguinte'] ?></strong>
					</div>
				</div>
			</div>
<?php 
$conclusion = $subeixos['totalPoints']/$dadosProgressao['pontuacao']*100;
if ($conclusion < 100){	 ?>
			<div class="col s8 offset-s2 progress grey" style="min-height:20px;">
				<div class="determinate green" style="width: <?php echo $conclusion ; ?>%"></div>
			</div>
<?php } else {?> 
			<div class="col s8 offset-s2">
	    		<a class="btn waves-effect waves-light green darken-4" href="<?php echo base_url().'index.php/usuario/finishprogressao';?>" style="width:100%;">Progredir
					<i class="material-icons right">forward</i>
				</a>
			</div>
<?php } ?>

			<div class="col s2">
			</div>

			<div class="col s8 offset-s2 right-align">
				<span><?php echo $subeixos['totalPoints'].'/'.$dadosProgressao['pontuacao']; ?></span>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<h5 class="left-align">Subeixos de Trabalho</h5>
			</div>
		</div>

		<div class="row">
<?php foreach ($subeixos as $subeixo): 
	if (!is_array($subeixo))	continue; ?>
			<div class="col s10 offset-s1">
				<ul class="collapsible" data-collapsible="accordion" style="line-height: 3rem; width:auto;">
			    	<li>
			    		<div class="collapsible-header blue darken-4" style="line-height: 3rem; font-weight: bold; color:white">
				      		<div class="col s10"><span class="truncate"><?php echo $subeixo['nome_subeixo'];?> </span></div>
				      		<div class="col s2"><span class="truncate"><?php echo $subeixo['subeixoPoints'].'/'.$subeixo['pontmax_subeixo'];?> </span></div>
			      		</div>
			      		<div class="collapsible-body col s12">
			      			<div class="col s4"><span class="truncate">Alias</span></div>
							<div class="col s4"><span class="truncate">Item</span></div>
							<div class="col s2"><span class="truncate">Pontuação</span></div>
							<div class="col s2"><span class="truncate">Valor/Classificação</span></div>
	<?php foreach ($subeixo['itens'] as $item): ?>
		<?php foreach ($item['producoes'] as $prod): ?>
							<div class="col s4"><span class="truncate"><?php echo $prod['nome_producao'];?></span></div>
							<div class="col s4"><span class="truncate"><?php echo $prod['nome_item'];?></span></div>
							<div class="col s2"><span class="truncate"><?php echo $prod['pontuacao_producao'];?></span></div>
			<?php if (isset($prod['quantidade_producao'])){ ?>
							<div class="col s2"><span class="truncate"><?php echo $prod['quantidade_producao'];?></span></div>
			<?php } else if (isset($prod['nome_classificacao'])) {?>
							<div class="col s2"><span class="truncate"><?php echo $prod['nome_classificacao'];?></span></div>
			<?php } else {?>
							<div class="col s2"><span class="truncate"></span></div>
			<?php } ?>
							
		<?php endforeach ?>
	<?php endforeach ?>
			      		</div>
				    </li>
				</ul>
			</div>
<?php endforeach ?>
		</div>
	
		<!--
		<pre><?php var_dump($subeixos); ?></pre>
		-->
	</main>
<script type="text/javascript">
$(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
});
</script>