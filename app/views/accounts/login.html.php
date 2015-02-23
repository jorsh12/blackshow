

<?php echo $this->_render('element', 'menu_otras_acciones'); ?>

<div class="row">
	<div class="col-md-6 col-md-offset-3 well-lg login">
		<?=$this->form->create($user, [
			// 'url' => [
			// 	'Accounts::login',
			// 	'?' => [
			// 		'redirect' => !empty($redirect) ? $redirect : '/'
			// 	]
			// ]
		]); ?>
		
		<fieldset>
			<legend><?=$this->title($t('Acceso a usuarios'));?></legend>
			<?=$this->form->fields($user->formFields([
				'email' => [
					'autofocus' => true,
				],
				'password'
			]));?>
			<?=$this->form->submit($t('Ingresar')); ?>
		</fieldset>
		<?=$this->form->end(); ?>		
	</div>
</div>

<?php $this->html->style([
	'clock.css',	
], [
	'inline' => false
]); ?>

<?php ob_start(); ?>
<script>
require([
	'<?=$this->url('/js/main.js');?>',
], function (common) {
	require(['<?=$this->url('/js/clock.js');?>']);
});
</script>
<?php $this->scripts(ob_get_clean()); ?>