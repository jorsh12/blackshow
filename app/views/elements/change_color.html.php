

<?php //echo$this->form->label('language', $t('Idioma')); ?>

<?=$this->form->select('color',
	array('default' => $t('Azul'), 'pink' => $t('Rosa'), 'light_blue' => $t('Azul Celeste')),
	array('id' => 'change-color', 'value' => $color)
	);
?>


<script>
	require([
		'<?=$this->url('/js/main.js');?>',
	], function (common) {
		require(['<?=$this->url('/js/change_color.js');?>']);
	});
</script>
