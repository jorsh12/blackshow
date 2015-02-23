<div class="row">
	<div class="col-md-6 col-md-offset-3 well">
		<?=$this->form->create($user); ?>
		<fieldset>
			<legend><?=$this->title('Editar Perfil');?></legend>
			<?=$this->form->fields($user->formFields([
				'nombre',
				'apellidoPaterno',
				'apellidoMaterno',
			]));?>
			<?=$this->form->submit('Guardar'); ?>

			<?=$this->html->link('Editar password', [
				'Accounts::edit_password',
			], [
				'class' => 'pull-right'
			]);?>
		</fieldset>
		<?=$this->form->end(); ?>
	</div>
</div>
