<?php $this->title('Registro Exitoso');?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="page-header">
			<h2>Para continuar con el registro...</h2>
		</div>

		<p class="lead">Ingresa a la cuenta de correo electronico proporcionada a la cual se envió un correo electronico para verificar su validez.</p>
		<p class="lead">Entra a tu correo electronico y da clic en la liga con el siguiente texto <i>"Click aqui para activar esta cuenta de correo"</i></p>
		<p class="lead">Una vez activada la cuenta de correo electrónico servirá para acceder al portal.</p>

		<?=$this->html->link('Ayuda', [
			'Pages::view',
			'args' => array('help')
		], [
			'class' => 'btn btn-info btn-block',
			'icon' => 'question-circle'
		]);?>

		<hr>

		<div class="well">
			<?=$this->form->create((!empty($user) ? $user : null), [
				'url' => [
					'Accounts::login',
				]
			]); ?>
			<fieldset>
				<legend>Acceso a usuarios</legend>
				<?=$this->form->fields($user->formFields([
					'email' => [
						'autofocus' => true,
					],
					'password'
				]));?>
				<?=$this->form->submit('Ingresar'); ?>

				<?=$this->html->link('Olvidaste tu contraseña?', [
					'Accounts::reset_password',
				], [
					'class' => 'pull-right'
				]);?>
			</fieldset>
			<?=$this->form->end(); ?>
		</div>
	</div>
</div>
