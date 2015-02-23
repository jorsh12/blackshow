
<div class='row'>
	
	<?php $title = $t('Contacto');
		echo $this->_render('element', 'texto_right', compact('title')); 
	?>

	<div class='col-xs-6 well-lg image-right form-contact'>
		<?=$this->form->create(compact('contactUs'), array('action' => 'add'));?>
		<div class='form-group'>
			<?=$this->form->label('category', $t("Categoría"));?>
			<?=$this->form->select('category', array(
				'producción_eventos' => 'Producción de Eventos',
				'renta_equipo' => 'Renta de Equipo',
				'venta' => 'Venta de globos, micas y accesorios de apoyo',
				'servicios' => 'Servicios de mantenimiento y reparación de equipos',
				'comentarios' => 'Comentarios y Sugerencias',
				), array('placeholder' => $t('Categoría')));?>
		</div>		
			<?=$this->form->field('name', array(
				'label' => $t("Nombre Completo"),
				'placeholder' => $t('Nombre Completo')
				));?>
			<?=$this->form->field('city', array(
				'label' => $t("Ciudad"),
				'placeholder' => $t('Ciudad')
				));?>
			<?=$this->form->field('fhone', array(
				'label' => $t("Teléfono"),
				'placeholder' => $t("Teléfono")
				));?>
			<?=$this->form->field('email', array(
				'label' => $t("Correo Electrónico"),
				'placeholder' => $t("Correo Electrónico")
				));?>
		<div class='form-group'>
			<?=$this->form->label('comments', $t("Comentarios"));?>
			<?=$this->form->textarea('comments', array('placeholder' => $t('Comentarios')));?>
		</div>		
		<?=$this->form->submit($t('Guardar'));?>		
		<?=$this->form->end();?>
	</div>
</div>