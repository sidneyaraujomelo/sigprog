	<main>
		<div class="row">
			<div class="col s12">
				<h4 class="center-align">Minhas Progressões</h4>
			</div>
			<div class="col s12">
				<hr>
				<ul class="tabs">
<?php foreach ($minhasprogressoes as $progressao) : ?>
					<li class="tab col s3"><a href="#<?php echo $progressao['id_prog_corrente']; ?>"><?php echo $progressao['cod_nivel_anterior'].'->'.$progressao['cod_nivel_seguinte']; ?></a></li>
<?php endforeach ?>
				</ul>
			</div>
		</div>
		<div class="row">
<?php foreach ($minhasprogressoes as $key => $progressao) : ?>
			<div id="<?php echo $progressao['id_prog_corrente']; ?>" class="col s12">
				<div class="row">
<?php 		if(isset($progressao['documento_prog_corrente'])) {?>
					<div class= "col s6">
						<a class="btn waves-effect waves-light green darken-4" href="<?php echo asset_url().'\\docs\\'.$progressao['documento_prog_corrente'];?>" download="<?php echo $progressao['documento_prog_corrente'];?>" style="width:100%;">Baixar Relatório
							<i class="material-icons right">file_download</i>
						</a>
					</div>
<?php 		} else { ?>
					<div class= "col s6"></div>
<?php 		}?>

<?php 		if($key==0 && isset($progressao['documento_prog_corrente'])) {?>
					<div  class= "col s6">
						<a class="btn waves-effect waves-light green darken-4" href="<?php echo base_url().'index.php/usuario/realizeprogressao';?>" style="width:100%;">Confirmar Progressão
							<i class="material-icons right">forward</i>
						</a>
					</div>
				
<?php 		} else { ?>
					<div class= "col s6"></div>
<?php 		}?>
				</div>

				<div class="col s12">
				<ul style="line-height: 3rem; width:auto;">
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
				</ul>
				</div>

<?php 	foreach ($progressao['producoes'] as $producao):?>
				<ul>
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
			      	</li>
			  	</ul>
<?php 	endforeach ?>
			</div>
<?php endforeach ?>
		</div>


	</main>