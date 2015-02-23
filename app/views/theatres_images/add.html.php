<h2 class="upload-file">
<?php
	echo $this->title($t('Subir Imagen de Teatros'));
?>
</h2>

<div class="upload-file">
	<?=$this->form->create($theatres, ['type' => 'file']);?>
		<fieldset>
			<legend><?=$t('Teatros');?></legend>
				<?=$this->form->field('file', [
					'type' => 'file',
					'label' => $t('Archivo')
				]);?>
			<!-- <div class='form-group'>
				<?=$this->form->textarea('descripcion', [
					'placeholder' => $t('Descripción')
				]); ?>
			</div> -->
			<?=$this->form->submit($t('Guardar')); ?>
		</fieldset>
	<?=$this->form->end(); ?>
</div>
