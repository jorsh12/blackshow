

<?php //echo$this->form->label('language', $t('Idioma')); ?>

<?=$this->form->select('language', 
	array('default' => 'Español', 'en' => 'English'),
	array('id' => 'change-language', 'value' => $language)
	);
?>


<script>
	require([
		'<?=$this->url('/js/main.js');?>',
	], function (common) {
		require(['<?=$this->url('/js/change_language.js');?>']);
	});
</script>