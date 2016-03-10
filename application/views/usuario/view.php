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

			<div class="col s8 offset-s2 progress">
				<div class="determinate" style="width: 70%"></div>
			</div>

			<div class="col s2">
			</div>

			<div class="col s8 offset-s2 right-align">
				<span>60/<?php echo $dadosProgressao['pontuacao']; ?></span>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<h5 class="left-align">Subeixos de Trabalho</h5>
			</div>
		</div>

		<div class="row">
<?php foreach ($subeixos as $subeixo): ?>
			<div class="col s10 offset-s1">
				<ul class="collapsible" data-collapsible="accordion" style="line-height: 3rem; width:auto;">
			    	<li>
			    		<div class="collapsible-header blue darken-4" style="line-height: 3rem; font-weight: bold; color:white">
				      		<div class="col s10"><span class="truncate"><?php echo $subeixo['nome_subeixo'];?> </span></div>
				      		<div class="col s2"><span class="truncate">5/<?php echo $subeixo['pontmax_subeixo'];?> </span></div>
			      		</div>
				    </li>
			</div>
<?php endforeach ?>
		</div>
	

		
	</main>