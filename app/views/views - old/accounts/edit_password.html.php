<div class="row">
	<div class="col-md-6 col-md-offset-3 well">
		<?=$this->form->create($user); ?>
		<fieldset>
			<legend><?=$this->title('Cambio de contraseña');?></legend>
			<?=$this->form->fields($user->formFields([
				'old_password' => [
					'type' => 'password',
					'placeholder' => 'Password Anterior',
					'label' => 'Password Anterior'
				],
				'password',
				'password_confirm' => [
					'type' => 'password',
					'placeholder' => 'Confirma Password',
					'label' => 'Confirma Password'
				],
			]));?>
			<?=$this->form->submit('Guardar'); ?>

			<?=$this->html->link('Olvidaste tu contraseña?', [
				'Accounts::recovery',
			], [
				'class' => 'pull-right'
			]);?>
		</fieldset>
		<?=$this->form->end(); ?>
	</div>
</div>
