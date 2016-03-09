	<main>
		<div class="row">
			<div class="col s12">
				<ul class="tabs">

<?php foreach ($minhasprogressoes as $progressao) : ?>
					<li class="tab col s3"><a href="#test1"><?php echo $progressao['fk_progressão']; ?></a></li>
<?php endforeach ?>
				</ul>
			</div>
		</div>

		<?php var_dump($minhasprogressoes);?>
	</main>