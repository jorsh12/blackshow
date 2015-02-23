<div class='row'>
	<div class='col-xs-6 texto-right-completo-iluminacion'>

		<h3><?php echo $title ?></h3>

		<div class='row'>
			<div class='col-xs-6'>
				<?=$this->html->link($t('Eventos Sociales'), [
						'EventsImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		</div>

		<div class='row'>
			<div class='col-xs-6'>
				<?=$this->html->link($t('Teatros y Festivales'), [
						'TheatresImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		</div>

		<div class='row'>
			<div class='col-xs-6'>
				<?=$this->html->link($t('Corporativo'), [
						'CorporateImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		</div>

		<div class='row'>
			<div class='col-xs-6'>
				<?=$this->html->link($t('Varios'), [
						'SeveralImages::view',
					], [
						'class' => ''
					]);?>
			</div>
		</div>	
	</div>
	<div class='col-xs-6 image-right'>
		<?php if ($this->_options['controller'] !== 'pages'): ?>
			<ul class='slider'>
				<?php foreach ($images as $image): ?>
					<li>
						<?=$this->html->link($t('Borrar'), [
							$this->_options['controller'] . '::delete',
							'id' => $image->id
						], [
							'class' => 'delete-image',
							'icon' => 'close'
						]);?>
						<?=$this->html->image('uploads/' . $image->name); ?>
						<!-- <p class='caption'><?=$image->descripcion;?></p> -->
					</li>			
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<?=$this->html->image('iluminacion.jpg'); ?>
		<?php endif; ?>
	</div>
</div>

<?php if(\app\models\Users::current()): ?>
<?=$this->html->link($t('Subir Archivo'), [
		$this->_options['controller'] . '::add'
	], [
		'class' => 'upload-file pull-right upload-file-add',
		'icon' => 'upload'
	]);?>
<?php endif; ?>

<?php $this->html->style([
	'/libs/9fevrier-responsiveslides/responsiveslides.css',
	'/libs/9fevrier-responsiveslides/theme.css'
], [
	'inline' => false
]); ?>

<?php ob_start(); ?>
<script>
require([
	'<?=$this->url('/js/main.js');?>',
], function (common) {
	require(['<?=$this->url('/js/carrusel_imagenes.js');?>']);
});
</script>
<?php $this->scripts(ob_get_clean()); ?>