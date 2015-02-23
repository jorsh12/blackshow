<h2 class="upload-file">
<?php
	echo $this->title($t("Subir Imagen de Eventos"));
?>
</h2>

<div class="upload-file">
	<?=$this->form->create($event, ['type' => 'file']);?>
		<fieldset>
			<legend><?=$t('Eventos');?></legend>
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
