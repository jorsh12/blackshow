<div class='row'>	
	<?php $title = $t('Iluminación');
		echo $this->_render('element', 'texto_right', compact('title')); 
	?>

	<div class='col-md-5 col-sm-4 col-xs-6 col-md-offset-1 col-xs-offset-1 col-sm-offset-1 well well-sm image-right'>
		<?php if ($this->_options['controller'] !== 'pages'): ?>
			<ul class='slider'>
				<?php foreach ($images as $image): ?>
					<li>
						<?=$this->html->link($t('Borrar'), [
							$this->_options['controller'] . '::delete',
							'id' => $image->id
						], [
							'class' => 'pull-right'
						]);?>
						<?=$this->html->image('uploads/' . $image->name); ?>
						<p class='caption'><?=$image->name;?></p>
					</li>			
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<?=$this->html->image('iluminacion.jpg'); ?>
		<?php endif; ?>
	</div>
</div>

<div class='row'>
	<div class='col-md-5 well well-sm texto-abajo-right'>
		<div class='row'>
			<div class='col-xs-3'>
				<?=$this->html->link($t('Eventos Sociales'), [
						'EventsImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		
			<div class='col-xs-3'>
				<?=$this->html->link($t('Teatros y Festivales'), [
						'TheatresImages::view',
					], [
						'class' => ''
					]);?>
			</div>
				
			<div class='col-xs-3'>
				<?=$this->html->link($t('Corporativo'), [
						'CorporateImages::view',
					], [
						'class' => ''
					]);?>
			</div>

			<div class='col-xs-3'>
				<?=$this->html->link($t('Varios'), [
						'SeveralImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		</div>
	</div>
</div>