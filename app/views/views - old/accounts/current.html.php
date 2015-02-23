<div class="row">
	<div class="col-md-6">
		<h2><?=$this->title($user->nombreCompleto);?> <small>«<?=$user->email;?>»</small></h2>
		<dl class="user">
			<dt>Email</dt>
			<dd><?=$user->email;?></dd>
			<dt>Last Login</dt>
			<dd><?=$this->time->to('words', $user->lastLogin);?></dd>
		</dl>

		<div class="btn-group">
			<?=$this->html->link('Editar Perfil', [
				'Accounts::edit',
			], [
				'class' => 'btn btn-default',
				'icon' => 'pencil'
			]);?>
			<?=$this->html->link('Cambiar Password', [
				'Accounts::edit_password',
			], [
				'class' => 'btn btn-default',
				'icon' => 'lock'
			]);?>
		</div>
	</div>
	<div class="col-md-6">
		<?php $image = $this->gravatar->image($user->email, [
			'size' => 300,
			'class' => 'img-reponsive img-thumbnail',
			'title' => $user->nombreCompleto,
			'alt' => $user->nombreCompleto
		]); ?>
		<?=$this->html->link($image, 'https://es.gravatar.com/', [
			'escape' => false,
		]);?>
	</div>
</div>

