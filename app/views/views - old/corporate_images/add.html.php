<h2 class="upload-file">
<?php
	echo $this->title($t('Subir Archivo de Corporativo'));
?>
</h2>

<div class="upload-file">
	<?=$this->form->create($corporate, ['type' => 'file']);?>
		<fieldset>
			<legend><?=$t('Corporativo');?></legend>
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
