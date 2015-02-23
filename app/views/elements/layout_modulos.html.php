

<div class='row'>

	<?php echo $this->_render('element', 'texto_right'); ?>

	<div class='col-md-5 col-sm-4 col-xs-6 col-md-offset-1 col-xs-offset-1 col-sm-offset-1 well well-sm image-right'>
		<?php echo $image ?>
	</div>
</div>


<?php if($this->_options['action'] !== 'audio' && $this->_options['action'] !== 'maintence'): ?>
	<div class='row'>
		<div class='col-md-5 well well-sm texto-abajo-right'>
			<?=$t('Proveedores');?>
			<div class='container-texto-abajo-right'>
				<?=$t('Contamos con una gran variedad de equipos de audio, iluminación, efectos especiales y videoproyección, de las marcas profesionales más reconocidas.');?>
			</div>
		</div>
	</div>
<?php endif; ?>