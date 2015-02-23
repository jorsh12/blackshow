<h2><?=$this->title("{:singular} {${:singular}->id}");?></h2>

<?php
$this->breadcrumbs->add('{:name}', '{:name}::index');
$this->breadcrumbs->add(
	"{:singular} {${:singular}->id}",
	['{:name}::view', 'id' => ${:singular}->id]
);
echo $this->breadcrumbs->create();
?>

<div class="btn-group">
	<?=$this->html->link('Edit', [
		'{:name}::edit',
		'id' => ${:singular}->id
	], [
		'class' => 'btn btn-default',
		'icon' => 'pencil'
	]);?>
	<?=$this->html->link('Delete', [
		'{:name}::delete',
		'id' => ${:singular}->id
	], [
		'class' => 'btn btn-default confirm',
		'icon' => 'trash'
	]);?>
	<?=$this->html->link('Versions', [
		'{:name}::versions',
		'id' => ${:singular}->id
	], [
		'class' => 'btn btn-default confirm',
		'icon' => 'users'
	]);?>
</div>

<dl class="{:singular}">
	<dt>ID</dt>
	<dd><?=${:singular}->id;?></dd>

	<dt>Created By</dt>
	<dd>
		<?=$this->html->link(${:singular}->createdBy->email, [
			'Users::view',
			'id' => ${:singular}->createdBy->id
		]);?>
	</dd>
	<dt>Created At</dt>
	<dd><?=$this->time->to('words', ${:singular}->createdAt);?></dd>
	<dt>Created From IP</dt>
	<dd><?=${:singular}->createdFromIp;?></dd>
	<dt>Updated By</dt>
	<dd>
		<?=$this->html->link(${:singular}->updatedBy->email, [
			'Users::view',
			'id' => ${:singular}->updatedBy->id
		]);?>
	</dd>
	<dt>Updated At</dt>
	<dd><?=$this->time->to('words', ${:singular}->updatedAt);?></dd>
	<dt>Updated From IP</dt>
	<dd><?=${:singular}->updatedFromIp;?></dd>
</dl>

<?php dump(${:singular}->data()); ?>
