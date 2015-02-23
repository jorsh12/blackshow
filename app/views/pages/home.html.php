

<?php echo $this->_render('element', 'menu_otras_acciones'); ?>

<div class='row'>
	<div class='col-md-2 col-xs-3 col-sm-2 well well-sm col-md-offset-3 col-xs-offset-1 col-sm-offset-1 image-home'>
		<?=$this->html->link($t('Nosotros') . '<br />' . $this->html->image('nosotros.jpg'), [
				'Pages::we',
			], [
				'class' => '',
				'icon' => 'institution'
			]);?>
		
	</div>
</div>

<div class='row'>
	<div class='col-md-2 col-xs-3 col-sm-1 well well-sm col-md-offset-2 col-xs-offset-0 col-sm-offset-0 image-home'>
		<?=$this->html->link($t('Audio') . $this->html->image('audio.jpg'), [
				'Pages::audio',
			], [
				'class' => '',
				'icon' => 'file-audio-o'
			]);?>
	</div>
	
	
	<div class='col-md-4 col-xs-9 col-sm-4 col-md-offset-1 image-home-logo'>
		<?=$this->html->image('logo_BlackShow_mod.png'); ?>
	</div>

</div>

<div class='row'>
	<div class='col-md-2 col-xs-3 col-sm-1 well well-sm col-md-offset-3 col-xs-offset-1 col-sm-offset-1 image-home image-home-iluminacion'>
		<?=$this->html->link($t('Iluminación') . $this->html->image('iluminacion.jpg'), [
				'Pages::lighting',
			], [
				'class' => '',
				'icon' => 'lightbulb-o'
			]);?>
	</div>

	<div class='col-md-2 col-xs-3 col-sm-1 well well-sm col-md-offset-1 col-xs-offset-1 col-sm-offset-1 image-home'>
		<?=$this->html->link($t('Video') . $this->html->image('video.jpg'), [
				'Pages::video',
			], [
				'class' => '',
				'icon' => 'video-camera'
			]);?>
	</div>

	<div class='col-md-2 col-xs-3 col-sm-1 well well-sm col-md-offset-1 col-xs-offset-1 col-sm-offset-1 image-home '>
		<?=$this->html->link($t('Reparación y Mantenimiento') . $this->html->image('reparacion.jpg'), [
				'Pages::maintence',
			], [
				'class' => '',
				'icon' => 'wrench'
			]);?>
	</div>
</div>