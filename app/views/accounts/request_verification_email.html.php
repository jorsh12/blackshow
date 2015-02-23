<div class="row">
	<div class="col-md-6 col-md-offset-3 well">
		<?=$this->form->create($user); ?>
		<fieldset>
			<legend><?=$this->title('Reenvio de correo de verificacion.');?></legend>
			<?=$this->form->fields($user->formFields([
				'email' => [
					'autofocus' => true,
				],
			]));?>
			<?=$this->form->submit('Enviar'); ?>
		</fieldset>
		<?=$this->form->end(); ?>
	</div>
</div>
