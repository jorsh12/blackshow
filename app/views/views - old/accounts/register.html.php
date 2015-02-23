<?php $this->title('Registro de usuarios');?>
<div class="row">
	<div class="col-md-6 col-md-offset-3 well">
		<?=$this->form->create($user); ?>
		<fieldset>
			<legend><?=$this->title('Registro de usuarios');?></legend>
			<?=$this->form->fields($user->formFields([
				'email' => [
					'autofocus' => true,
				],
				'nombre',
				'apellidoPaterno',
				'apellidoMaterno',
				'password',
				'password_confirm' => [
					'type' => 'password',
					'placeholder' => 'Confirma Password',
					'label' => 'Confirma Password'
				],
			]));?>
			<?=$this->form->submit('Registrar'); ?>

			<?=$this->html->link('Ya registrado?', [
				'Accounts::login',
			], [
				'class' => 'pull-right'
			]);?>
		</fieldset>
		<?=$this->form->end(); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<hr>

		<p>
			No me llego el correo de verificacion.
		</p>
		<?=$this->html->link('Reenvio de correo de verificacion.', [
			'Accounts::request_verification_email',
		], [
			'class' => 'btn btn-default btn-block'
		]);?>
	</div>
</div>
