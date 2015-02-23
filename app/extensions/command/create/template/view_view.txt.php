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
</div>

<dl class="{:singular}">
	<dt>ID</dt>
	<dd><?=${:singular}->id;?></dd>
</dl>

<?php dump(${:singular}->data()); ?>
