<h2><?=$this->title("{:singular} {${:singular}->id} Versions");?></h2>

<?php
$this->breadcrumbs->add('{:name}', '{:name}::index');
$this->breadcrumbs->add(
	"{:singular} {${:singular}->id}",
	['{:name}::view', 'id' => ${:singular}->id]
);
$this->breadcrumbs->add(
	'Versions',
	['{:name}::versions', 'id' => ${:singular}->id]
);
echo $this->breadcrumbs->create();
?>

<div class="btn-group">
	<?=$this->html->link('View', [
		'{:name}::view',
		'id' => ${:singular}->id
	], [
		'class' => 'btn btn-default',
		'icon' => 'eye'
	]);?>
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

<?=$this->element->logEntries(compact('entries')); ?>

<h3>Actual version</h3>
<?php dump(${:singular}->data()); ?>
